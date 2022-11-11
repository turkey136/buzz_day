<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitemapController extends Controller
{
	public function sitemap()
  {
      return response()->view('sitemap.sitemap')->header('Content-Type', 'text/xml');
	}
}
