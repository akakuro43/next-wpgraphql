<?php 
$url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
parse_str(parse_url($url, PHP_URL_QUERY), $query);
if (isset($query)) {
  $searchWord = $query['s'];
}
?>

<form class="search-from" method="get" action="<?php echo home_url('/'); ?>" >
  <input class="searchTxt" id="keyword" type="text" name="s" placeholder="キーワードで検索" value="<?php echo $searchWord; ?>">
  <button class="searchBtn" type="submit">
    <svg class="c-search" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 22 22" id="">
      <circle cx="8.48528" cy="9.40686" r="5" transform="rotate(-45 8.48528 9.40686)" stroke="#302D2A" stroke-width="2"></circle>
      <line x1="13.076" y1="13.3788" x2="16.4347" y2="16.7376" stroke="#302D2A" stroke-width="2" stroke-linecap="round"></line>
    </svg>
  </button>
</form>