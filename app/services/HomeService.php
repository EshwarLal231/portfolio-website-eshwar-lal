<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Portfolio;
use App\Models\Qualification;
use App\Models\Review;
use App\Models\Service;
use App\Models\Skill;
use App\Models\User;
use App\Models\Setting;

class HomeService
{
    /**
     * Get all the data for the home API.
     *
     * @return array
     */
    public function getHomeData()
    {
        $user = User::select(
            'id',
            'name',
            'email',
            'phone',
            'address',
            'job',
            'degree',
            'profile_pic',
            'birth_day',
            'experience'
        )->where('id', 1)->first();

        $experiences = Qualification::where('type', 'Work')->orderBy('id', 'desc')->take(3)->get();
        $educations = Qualification::where('type', 'Education')->orderBy('id', 'desc')->take(3)->get();
        $skills = Skill::orderBy('id', 'desc')->take(6)->get();
        $services = Service::take(6)->get();
        $categories = Category::all();
        $reviewers = Review::orderBy('id', 'desc')->take(5)->get();
        $portfolios = Portfolio::with('category')->orderBy('id', 'desc')->take(6)->get();
        $setting = Setting::first();

        return [
            'user' => $user,
            'experiences' => $experiences,
            'educations' => $educations,
            'skills' => $skills,
            'services' => $services,
            'categories' => $categories,
            'portfolios' => $portfolios,
            'setting' => $setting,
            'reviewers' => $reviewers,
        ];
    }
}
