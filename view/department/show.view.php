<?php
function department_show_view(array $data):string {
    $string = "<div>{$data['name']}</div>";
    $string .= "<div>{$data['id']}</div>";
    $string .= "<div>{$data['work_mode']}</div>";
    $string .= "<div>{$data['hiring']}</div>";
    $string .= "<a href='' ></a>";
}