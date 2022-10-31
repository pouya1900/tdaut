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

    public static function genderToTranslated($gender)
    {
        switch ($gender) {
            case "male" :
                return trans('trs.male');
            case "female" :
                return trans('trs.female');
        }
    }

    public static function supportStatusToTranslated($status)
    {
        switch ($status) {
            case "pending" :
                return trans('trs.pending');
            case "answered" :
                return trans('trs.answered');
            case "closed" :
                return trans('trs.closed');
        }
    }
}
