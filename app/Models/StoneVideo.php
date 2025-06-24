<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoneVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'video_url',
        'thumbnail',
        'status',
        'is_featured',
        'order'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    /**
     * Lấy embed code từ video URL (YouTube, Vimeo)
     */
    public function getEmbedCodeAttribute(): string
    {
        if (strpos($this->video_url, 'youtube.com') !== false || strpos($this->video_url, 'youtu.be') !== false) {
            $video_id = '';
            
            if (strpos($this->video_url, 'youtube.com/watch?v=') !== false) {
                $parts = parse_url($this->video_url);
                parse_str($parts['query'], $query);
                $video_id = $query['v'] ?? '';
            } elseif (strpos($this->video_url, 'youtu.be/') !== false) {
                $parts = explode('/', $this->video_url);
                $video_id = end($parts);
            }
            
            if ($video_id) {
                return '<iframe width="100%" height="315" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            }
        } elseif (strpos($this->video_url, 'vimeo.com') !== false) {
            $video_id = '';
            
            $parts = explode('/', $this->video_url);
            $video_id = end($parts);
            
            if ($video_id) {
                return '<iframe src="https://player.vimeo.com/video/' . $video_id . '" width="100%" height="315" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
            }
        }
        
        // Nếu không phải YouTube hoặc Vimeo, trả về video tag
        return '<video width="100%" height="315" controls><source src="' . $this->video_url . '" type="video/mp4">Your browser does not support the video tag.</video>';
    }
} 