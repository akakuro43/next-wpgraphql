<?php 

$loginFlg = getSessionLoginFlg();

$id = get_the_id();
$startTime = get_field('start_time');
$endTime = get_field('end_time');

$eventDate = date_create(get_field('date'));
$week = array("日", "月", "火", "水", "木", "金", "土");
$w = (int)date_format($eventDate, 'w');
$youbi = $week[$w];

$postThumbnail = get_the_post_thumbnail_url($id, 'large');

$labFlag = get_field('lab_flag');
$labLabel = $labFlag ? 'c-label-lab' : '';

$postTitle = get_the_title();
$isDot = mb_strlen($postTitle) > 45;
$postTitle = mb_substr($postTitle, 0, 45);
if($isDot) {
  $postTitle = $postTitle. "...";
}

$eventUrl = get_field('event_url');
?>

<li class="event__item">
  <p class="datetime"><span class="date"><?php echo date_format($eventDate,'Y.m.d'); ?>(<?php echo $youbi; ?>)</span><span class="time"><?php echo $startTime; ?> ~ <?php echo $endTime; ?></span></p><a class="link" href="<?php echo the_permalink(); ?>"><img class="thumb" src="<?php echo $postThumbnail; ?>">
    <h3 class="title <?php echo $labLabel; ?>"><?php echo $postTitle; ?></h3></a>
    <?php if($loginFlg) : ?>
    <a class="btn-regist-calendar" href="https://www.google.com/calendar/render?action=TEMPLATE&amp;text=<?php echo $postTitle; ?>&amp;dates=<?php echo date_format($eventDate,'Ymd'); ?>T<?php echo str_replace(':','',$startTime); ?>00/<?php echo date_format($eventDate,'Ymd'); ?>T<?php echo str_replace(':','',$endTime); ?>00&amp;location=<?php echo $eventUrl ?>&amp;trp=true&amp;trp=undefined&amp;trp=true&amp;sprop=" target="_blank"><span class="icn">
      <svg class="c-calendar" xmlns="http://www.w3.org/2000/svg" width="15" height="13" viewBox="0 0 13 11" id="">
        <path d="M9.53407 7.64431V8.92303C9.53407 9.4234 9.1171 9.84037 8.61673 9.84037H5.05855H1.91734C1.41697 9.84037 1 9.4234 1 8.92303V2.19585C1 1.69548 1.41697 1.2785 1.91734 1.2785H3.05707" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
        <path d="M7.50391 1.2785H8.64364C9.14401 1.2785 9.56098 1.69548 9.56098 2.19585V4.86448" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
        <path d="M3.05859 1.2785H7.50632" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
        <path d="M1 3.64148H9.53407" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
        <path d="M3.05859 1.86232V0.666992" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
        <path d="M7.50391 1.86232V0.666992" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
        <path d="M8.86503 8.31153L11.895 5.28151C12.034 5.14252 12.034 4.92014 11.895 4.78115L11.0055 3.9194C10.8665 3.78041 10.6441 3.78041 10.5051 3.9194L7.50291 6.94941L7.08594 8.7285L8.86503 8.31153Z" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
        <path d="M9.72656 4.69772L11.0887 6.08764" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
        <path d="M7.50391 6.94937L8.86602 8.31149" stroke="white" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
      </svg></span><span class="txt">Goolge カレンダーに登録</span>
    </a>
    <?php endif; ?>
</li>