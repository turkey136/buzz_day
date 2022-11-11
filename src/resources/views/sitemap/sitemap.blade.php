<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
      <loc>{{ route('investment_trust.investment_trust_statistics_graph') }}</loc>
      <lastmod>{{ date("Y-m-d") }}</lastmod>
  </url>
  <url>
      <loc>{{ route('investment_trust.investment_trust_statistics') }}</loc>
      <lastmod>{{ date("Y-m-d") }}</lastmod>
  </url>
  <url>
      <loc>{{ route('investment_trust') }}</loc>
      <lastmod>{{ date("Y-m-d") }}</lastmod>
  </url>
  <url>
      <loc>{{ route('buzzTop.buzzNico') }}</loc>
      <lastmod>{{ date("Y-m-d") }}</lastmod>
  </url>
  <url>
      <loc>{{ route('buzzTop.buzzTube') }}</loc>
      <lastmod>{{ date("Y-m-d") }}</lastmod>
  </url>
    <url>
      <loc>{{ route('buzzTop') }}</loc>
      <lastmod>{{ date("Y-m-d") }}</lastmod>
  </url>
  <url>
      <loc>{{ route('novel.top') }}</loc>
      <lastmod>{{ date("Y-m-d") }}</lastmod>
  </url>
  <url>
      <loc>{{ route('novel.yomou') }}</loc>
      <lastmod>{{ date("Y-m-d") }}</lastmod>
  </url>
  <url>
      <loc>{{ route('top') }}</loc>
      <lastmod>{{ date("Y-m-d") }}</lastmod>
  </url>
</urlset>
