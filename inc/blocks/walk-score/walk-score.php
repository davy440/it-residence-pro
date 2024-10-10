<?php
/**
 * Walk Score Block.
 * 
 * @param   array   $attributes     The block attributes.
 * @param   string  $content        The block default content.
 * @param   object  $block          WP_Block - The block instance.
 */

$post_id = $block->context['postId'];
$property_info = get_post_meta($post_id);
$street = !empty($property_info['streetName']) ? $property_info['streetName'][0] : '';
$city = !empty($property_info['city']) ? $property_info['city'][0] : '';
$province = !empty($property_info['province']) ? $property_info['province'][0] : '';
$country = !empty($property_info['country']) ? $property_info['country'][0] : '';
$zip = !empty($property_info['zip']) ? $property_info['zip'][0] : '';
$lat = !empty($property_info['lat']) ? $property_info['lat'][0] : '';
$long = !empty($property_info['long']) ? $property_info['long'][0] : '';
if (empty($street) || empty($city) || empty($province) || empty($lat) || empty($long)) {
    return;
}
?>

<section class="itre-walk-score">
<div class="itre-walk-score__wrapper">
    <?php
        $url = 'https://api.walkscore.com/score';

        $urlArgs = [];
        $urlArgs['format'] = 'json';
        $urlArgs['address'] =str_replace(' ', '%20', "{$street} {$city} {$province}");
        $urlArgs['lat'] = $lat;
        $urlArgs['lon'] = $long;
        $urlArgs['transit'] = 1;
        $urlArgs['bike'] = 1;
        $urlArgs['wsapikey'] = 'ab8dd6bd1447bc563f32a8ed09c16e6d';
        
        $url = add_query_arg($urlArgs, $url);
        $data = file_get_contents($url);
        
        if (!empty($data)) {
            $data = json_decode( $data );
            $walk_score = $data->walkscore;
            $walk_desc = $data->description;

            if (!empty($walk_score) && !empty($walk_desc)) {
                printf('<div class="itre-walk-score__walk"><h3 class="itre-walk-score__item-title">%s</h3><div class="itre-walk-score__icon"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M13.5 5.5c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zM9.8 8.9L7 23h2.1l1.8-8 2.1 2v6h2v-7.5l-2.1-2 .6-3C14.8 12 16.8 13 19 13v-2c-1.9 0-3.5-1-4.3-2.4l-1-1.6c-.56-.89-1.68-1.25-2.65-.84L6 8.3V13h2V9.6l1.8-.7"/></svg></div><p class="itre-walk-score__desc"><span class="itre-walk-score__score">%s</span>%s</p></div>', esc_html__('Walk Score®', 'it-residence'), $walk_score, esc_html($walk_desc));
            } else {
                printf('<div class="itre-walk-score__walk"><h3 class="itre-walk-score__item-title">%s</h3><div class="itre-walk-score__icon"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#bbbbbb"><path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg></div><p class="itre-walk-score__desc">%s</p></div>', esc_html__('Walk Score®', 'it-residence'), __('Not Available', 'it-residence'));
            }
            
            if (!empty($data->transit)) {
                $transit_score = $data->transit->score;
                $transit_desc = $data->transit->description;
                printf('<div class="itre-walk-score__transit"><h3 class="itre-walk-score__item-title">%s</h3><div class="itre-walk-score__icon"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><circle cx="8.5" cy="14.5" r="1.5"/><circle cx="15.5" cy="14.5" r="1.5"/><path d="M12 2c-4 0-8 .5-8 4v9.5C4 17.43 5.57 19 7.5 19L6 20.5v.5h2l2-2h4l2 2h2v-.5L16.5 19c1.93 0 3.5-1.57 3.5-3.5V6c0-3.5-4-4-8-4zm0 2c3.51 0 4.96.48 5.57 1H6.43c.61-.52 2.06-1 5.57-1zM6 7h5v3H6V7zm12 8.5c0 .83-.67 1.5-1.5 1.5h-9c-.83 0-1.5-.67-1.5-1.5V12h12v3.5zm0-5.5h-5V7h5v3z"/></svg></div><p class="itre-walk-score__desc"><span class="itre-walk-score__score">%s</span>%s</p></div>', esc_html__('Transit Score®', 'it-residence'), $transit_score, esc_html($transit_desc));
            } else {
                printf('<div class="itre-walk-score__transit"><h3 class="itre-walk-score__item-title">%s</h3><div class="itre-walk-score__icon"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#bbbbbb"><path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg></div><p class="itre-walk-score__desc">%s</p></div>', esc_html__('Transit Score®', 'it-residence'), __('Not Available', 'it-residence'));
            }

            if (!empty($data->bike)) {
                $bike_score = $data->bike->score;
                $bike_desc = $data->bike->description;
                printf('<div class="itre-walk-score__bike"><h3 class="itre-walk-score__item-title">%s</h3><div class="itre-walk-score__icon"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 5.5c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zM5 12c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 8.5c-1.9 0-3.5-1.6-3.5-3.5s1.6-3.5 3.5-3.5 3.5 1.6 3.5 3.5-1.6 3.5-3.5 3.5zm5.8-10l2.4-2.4.8.8c1.3 1.3 3 2.1 5.1 2.1V9c-1.5 0-2.7-.6-3.6-1.5l-1.9-1.9c-.5-.4-1-.6-1.6-.6s-1.1.2-1.4.6L7.8 8.4c-.4.4-.6.9-.6 1.4 0 .6.2 1.1.6 1.4L11 14v5h2v-6.2l-2.2-2.3zM19 12c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 8.5c-1.9 0-3.5-1.6-3.5-3.5s1.6-3.5 3.5-3.5 3.5 1.6 3.5 3.5-1.6 3.5-3.5 3.5z"/></svg></div><p class="itre-walk-score__desc"><span class="itre-walk-score__score">%s</span>%s</p></div>', esc_html__('Bike Score®', 'it-residence'), $bike_score, esc_html($bike_desc));
            } else {
                printf('<div class="itre-walk-score__bike"><h3 class="itre-walk-score__item-title">%s</h3><div class="itre-walk-score__icon"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#bbbbbb"><path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg></div><p class="itre-walk-score__desc">%s</p></div>', esc_html__('Bike Score®', 'it-residence'), __('Data Not Available', 'it-residence'));
            }
        }
       
    ?>
</div>
</section>