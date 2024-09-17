<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matches extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $casts = [
        'started_at' => 'datetime',
        'home_scores' => 'array',
        'away_scores' => 'array',
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    }

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function status()
    {
        $status = match ($this->status_id) {
            StatusEnum::NOT_STARTED->value => 'Chưa bắt đầu',
            StatusEnum::FIRST_HALF->value => 'Hiệp 1',
            StatusEnum::HALF_TIME->value => 'Nghỉ giữa hiệp',
            StatusEnum::SECOND_HALF->value => 'Hiệp 2',
            StatusEnum::OVERTIME->value => 'Hiệp phụ',
            StatusEnum::OVERTIME_DEPRECATED->value => 'Hiệp phụ (!)',
            StatusEnum::PENALTY->value => 'Loạt sút luân lưu',
            StatusEnum::END->value => 'Kết thúc',
            StatusEnum::DELAY->value => 'Bị hoãn',
            default => 'Không rõ',
        };
        return $status;
    }

    public function isInProgress()
    {
        return in_array($this->status_id, [
            StatusEnum::FIRST_HALF->value,
            StatusEnum::SECOND_HALF->value,
        ]);
    }

    public function playedMinutesTime()
    {
        return floor(($this->match_time - $this->started_at->unix()) / 60);
    }
}
