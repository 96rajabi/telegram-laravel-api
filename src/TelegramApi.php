<?php


namespace Mahdiidea\TelegramApi;


use Illuminate\Support\Facades\Facade;

/**
 * Class TelegramApi
 * @package Mahdiidea\TelegramApi
 *
 *
 * @method static mixed getMe()
 * @method static mixed sendMessage(array $array)
 * @method static mixed forwardMessage(array $array)
 * @method static mixed copyMessage(array $array)
 * @method static mixed sendPhoto(string $photo, array $array)
 * @method static mixed sendAudio(string $audio, array $array)
 * @method static mixed sendDocument(string $document, array $array)
 * @method static mixed sendVideo(string $video, array $array)
 * @method static mixed sendAnimation(string $animation, array $array)
 * @method static mixed sendVoice(string $voice, array $array)
 * @method static mixed sendVideoNote(string $voiceNote, array $array)
// * @method static mixed sendMediaGroup(array $media, array $array)
 *
 */
class TelegramApi extends Facade
{
    /**
     * The name of the binding in the IoC container.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'telegram';
    }
}
