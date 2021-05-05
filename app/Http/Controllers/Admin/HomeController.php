<?php

namespace App\Http\Controllers\Admin;

use App\Models\BusinessAccount;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Organisations',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\BusinessAccount',
            'group_by_field'        => 'date_created',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
            'translation_key'       => 'businessAccount',
        ];

        $settings1['total_number'] = 0;
        if (class_exists($settings1['model'])) {
            $settings1['total_number'] = $settings1['model']::when(isset($settings1['filter_field']), function ($query) use ($settings1) {
                if (isset($settings1['filter_days'])) {
                    return $query->where($settings1['filter_field'], '>=',
                now()->subDays($settings1['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings1['filter_period'])) {
                    switch ($settings1['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings1['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings1['aggregate_function'] ?? 'count'}($settings1['aggregate_field'] ?? '*');
        }

        $settings2 = [
            'chart_title'           => 'Employees',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Employee',
            'group_by_field'        => 'timestamp',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
            'translation_key'       => 'employee',
        ];

        $settings2['total_number'] = 0;
        if (class_exists($settings2['model'])) {
            $settings2['total_number'] = $settings2['model']::when(isset($settings2['filter_field']), function ($query) use ($settings2) {
                if (isset($settings2['filter_days'])) {
                    return $query->where($settings2['filter_field'], '>=',
                now()->subDays($settings2['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings2['filter_period'])) {
                    switch ($settings2['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings2['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings2['aggregate_function'] ?? 'count'}($settings2['aggregate_field'] ?? '*');
        }

        $settings3 = [
            'chart_title'           => 'Admins',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\User',
            'group_by_field'        => 'email_verified_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
            'translation_key'       => 'user',
        ];

        $settings3['total_number'] = 0;
        if (class_exists($settings3['model'])) {
            $settings3['total_number'] = $settings3['model']::when(isset($settings3['filter_field']), function ($query) use ($settings3) {
                if (isset($settings3['filter_days'])) {
                    return $query->where($settings3['filter_field'], '>=',
                now()->subDays($settings3['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings3['filter_period'])) {
                    switch ($settings3['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings3['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings3['aggregate_function'] ?? 'count'}($settings3['aggregate_field'] ?? '*');
        }

        $settings4 = [
            'chart_title'           => 'Today Attendance',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Attendance',
            'group_by_field'        => 'date',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'date',
            'filter_days'           => '1',
            'group_by_field_format' => 'Y-m-d',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
            'translation_key'       => 'attendance',
        ];

        $settings4['total_number'] = 0;
        if (class_exists($settings4['model'])) {
            $settings4['total_number'] = $settings4['model']::when(isset($settings4['filter_field']), function ($query) use ($settings4) {
                if (isset($settings4['filter_days'])) {
                    return $query->where($settings4['filter_field'], '>=',
                today()->format('Y-m-d'));
                }
                if (isset($settings4['filter_period'])) {
                    switch ($settings4['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings4['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings4['aggregate_function'] ?? 'count'}($settings4['aggregate_field'] ?? '*');
        }

        $settings5 = [
            'chart_title'        => 'Attendances',
            'chart_type'         => 'line',
            'report_type'        => 'group_by_date',
            'model'              => 'App\Models\Attendance',
            'group_by_field'     => 'date',
            'group_by_field_format' => 'Y-m-d',
            'date_format_filter_days' => 'Y-m-d',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field'       => 'date',
            'filter_period'      => 'month',
            'column_class'       => 'col-md-12',
            'translation_key'    => 'attendance',
            'continuous_time' => true,
            'conditions'            => $this->generateConditions(),

        ];

        $chart5 = new LaravelChart($settings5);

        $settings6 = [
            'chart_title'           => 'Latest Employees',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Employee',
            'group_by_field'        => 'timestamp',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'timestamp',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-12',
            'entries_number'        => '10',
            'fields'                => [
                'emp_id'  => '',
                'organisation'=> 'BS_Name',
                'name'        => '',
//                'department'  => '',
                'GenId'       => '',
                'timestamp'  => '',
            ],
            'translation_key' => 'employee',
        ];

        $settings6['data'] = [];
        if (class_exists($settings6['model'])) {
            $settings6['data'] = $settings6['model']::orderBy('timestamp', 'DESC')
                ->take($settings6['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings6)) {
            $settings6['fields'] = [];
        }

        $settings7 = [
            'chart_title'           => 'Latest Attendances',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Attendance',
            'group_by_field'        => 'date',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'date',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-12',
            'entries_number'        => '10',
            'fields'                => [
                'employee'  => 'name',
                'bsid'=> 'BS_Name',
                'date'        => '',
                'time_in'  => '',
                'time_out'       => '',
//                'location'  => '',
            ],
            'translation_key' => 'attendance',
        ];

        $settings7['data'] = [];
        if (class_exists($settings7['model'])) {
            $settings7['data'] = $settings7['model']::orderBy('date', 'DESC')
                ->take($settings7['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings7)) {
            $settings7['fields'] = [];
        }

        $settings8 = [
            'chart_title'           => 'Latest Organisations',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\BusinessAccount',
            'group_by_field'        => 'Date_Created',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'Date_Created',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-12',
            'entries_number'        => '10',
            'fields'                => [
                'id'  => '',
                'BS_Name'  => '',
                'BS_ID'=> '',
//                'BS_Email'  => '',
                'BS_Contact'  => '',
                'logoUrl'  => '',
                'totalHoursSpent'  => '',
            ],
            'translation_key' => 'businessAccount',
        ];

        $settings8['data'] = [];
        if (class_exists($settings8['model'])) {
            $settings8['data'] = $settings8['model']::orderBy('Date_Created', 'DESC')
                ->get()
                ->sortByDesc('totalHoursSpent')
                ->take($settings8['entries_number']);
        }

        if (!array_key_exists('fields', $settings8)) {
            $settings8['fields'] = [];
        }

        $settings9 = [
            'chart_title'           => 'Most Active Users',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Employee',
            'group_by_field'        => 'Date_Created',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'Date_Created',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-12',
            'entries_number'        => '10',
            'fields'                => [
                'id'  => '',
                'emp_id'  => '',
                'BS_ID'=> '',
                'name'        => '',
                'GenId'       => '',
                'timestamp'  => '',
                'attendedTimes'  => '',
            ],
            'translation_key' => 'employee',
        ];

        $settings9['data'] = [];
        if (class_exists($settings9['model'])) {
            $settings9['data'] = $settings9['model']::orderBy('timestamp', 'DESC')
                ->get()
                ->sortByDesc('attendedTimes')
                ->take($settings9['entries_number']);
        }

        if (!array_key_exists('fields', $settings9)) {
            $settings9['fields'] = [];
        }

        return view('home', compact('settings1', 'settings2', 'settings3',
            'settings4', 'chart5', 'settings6', 'settings7', 'settings8', 'settings9'));
    }

    public function generateConditions()
    {
        $colors = ['#A3A3FE', '#A5A5A5', '#ED7D31', '#FFBF00', '#CCCCFF', '#000080', '#800080', '#008080', '#00FFFF',
        '#008000', '#fc9cb5', '#719c70', '#f46732', '#c6bdff', '#e43553'
        ];
        $orgs = BusinessAccount::all();
        $conditions = [];
        foreach ($orgs as $i => $org) {
            $color = array_rand($colors);
            $conditions[] = [
                'name' => "$org->BS_Name", 'condition' => 'BS_ID = "'.$org->BS_ID.'"',
                'color' => "$colors[$color]", 'fill' => false
            ];
        }

        return $conditions;
    }
}
