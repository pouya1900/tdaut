<?php

namespace App;


class Helper
{

    public static function memberType($type)
    {
        switch ($type) {
            case "professor" :
                return trans('trs.professor');
            case "student" :
                return trans('trs.student');
            case "staff" :
                return trans('trs.staff');
        }
    }
}
