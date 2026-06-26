<?php

declare(strict_types=1);

namespace Molitor\PostCalendar\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Molitor\Cms\Models\Post;
use Molitor\PostCalendar\Services\PostCalendarSettingForm;
use Molitor\Theme\Services\LayoutService;

class PostCalendarController extends Controller
{
    public function __construct(
        private PostCalendarSettingForm $settingForm,
        private LayoutService $layoutService,
    ) {}

    public function index(Request $request): View
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        $postsByDay = Post::query()
            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->where('is_published', true)
            ->get()
            ->groupBy(fn ($post) => $post->created_at->format('Y-m-d'));

        $layout = $this->layoutService->getLayoutTemplate(
            $this->settingForm->get('post_calendar_index_layout')
        );

        return view('post-calendar::index', [
            'postsByDay' => $postsByDay,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'month' => (int) $month,
            'year' => (int) $year,
            'layout' => $layout,
        ]);
    }

    public function showDay(string $date): View
    {
        $parsedDate = Carbon::parse($date);

        $posts = Post::query()
            ->whereDate('created_at', $parsedDate)
            ->where('is_published', true)
            ->get();

        $layout = $this->layoutService->getLayoutTemplate(
            $this->settingForm->get('post_calendar_day_layout')
        );

        return view('post-calendar::day', [
            'posts' => $posts,
            'date' => $parsedDate,
            'layout' => $layout,
        ]);
    }
}
