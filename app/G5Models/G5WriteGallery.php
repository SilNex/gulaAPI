<?php

namespace App\G5Models;

use SilNex\GuLa\G5Model;
use SilNex\GuLa\Models\Gnu\G5BoardFile;
use SilNex\GuLa\Traits\BelongToG5Member;

class G5WriteGallery extends G5Model
{
    use BelongToG5Member;

    protected $table = 'g5_write_gallery';

    /**
     * 할당(수정) 불가능한 속성(컬럼)
     *
     * @var array
     */
    protected $fillable = ['wr_id', 'wr_num', 'wr_reply', 'wr_parent', 'wr_is_comment', 'wr_comment', 'wr_comment_reply', 'ca_name', 'wr_option', 'wr_subject', 'wr_content', 'wr_seo_title', 'wr_link1', 'wr_link2', 'wr_link1_hit', 'wr_link2_hit', 'wr_hit', 'wr_good', 'wr_nogood', 'mb_id', 'wr_password', 'wr_name', 'wr_email', 'wr_homepage', 'wr_datetime', 'wr_file', 'wr_last', 'wr_ip', 'wr_facebook_user', 'wr_twitter_user', 'wr_1', 'wr_2', 'wr_3', 'wr_4', 'wr_5', 'wr_6', 'wr_7', 'wr_8', 'wr_9', 'wr_10'];

    /**
     * 숨길 속성(컬럼)
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * 속성별 결과 변환 설정
     *
     * @var array
     */
    protected $casts = [];

    /**
     * 시간 속성(컬럼)
     *
     * @var array
     */
    protected $dates = ['wr_datetime'];

    /**
     * 댓글 리스트
     */
    public function comments()
    {
        return $this->hasMany(G5WriteGallery::class, 'wr_parent', 'wr_id');
    }

    /**
     * 댓글이라면, 게시글을 보여줌
     */
    public function parent()
    {
        if ($this->wr_is_comment) {
            return $this->belongsTo(G5WriteGallery::class, 'wr_id', 'wr_parent');
        } else {
            throw new \Exception("해당 글은 댓글이 아닙니다.");
        }
    }

    public function files()
    {
        return $this->hasMany(G5BoardFile::class, 'wr_id', 'wr_id')->where('bo_table', 'gallery');
    }
}