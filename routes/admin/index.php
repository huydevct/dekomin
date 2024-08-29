<?php

use Illuminate\Support\Facades\Route;

Route::prefix("admin")->middleware(['auth'])->group(function (){
    require "categories.php";
//    require "types.php";
//    require "apps.php";
//    require "lock_screens.php";
//    require "log_traffic.php";
//    require "color_phones.php";
//    require "contents.php";
//    require "gifs.php";
//    require "fonts.php";
//    require "category_v2.php";
//    require "count_downs.php";
//    require "inlines.php";
//    require "times.php";
//    require "count_down_ls.php";
//    require "pet_widgets.php";
//    require "stand_bys.php";
//    require "clock_images.php";
//    require "games.php";
//    require "asmrs.php";
//    require "status_image.php";
//    require "friends.php";
//    require "users.php";
//    require "messages.php";
//    require "stickers.php";
//    require "flower_diy.php";
//    require "background.php";
//    require "flower_widget.php";
});
