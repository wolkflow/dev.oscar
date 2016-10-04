<?php

namespace Glyf\Core\Utils;

/**
 * Class ImageCrypt
 */
class ImageCrypt
{
	const DEFLATE_LEVEL = 9;
	const MIN_IMAGE_OFFSET = 4096;
	
	protected static $step  = 1024;
	protected static $size  = 4;
    
    
    /**
     * ����� ����������.
     */
    public function crypt($source, $target, $message)
    {
        $source  = (string) $source;
        $target  = (string) $target;
        $message = (string) $message;
        
        // ���� ���������� ������.
        $canwrite = true;
        
		// ����� ���������.
		$length = strlen($message);
		
		// ������ �����.
        $filesize = filesize($source);
        
        $fps = fopen($source, 'r');
        $fpt = fopen($target, 'wb');
        
		// ������ ������.
		$message = gzdeflate($message, self::DEFLATE_LEVEL);
		
		fwrite($fpt, fread($fps, $filesize));
		fwrite($fpt, $message, strlen($message));
		
        fclose($fps);
        fclose($fpt);
    }
    
	
	/**
     * ����� �������������.
     */
    public function decrypt($source, $message)
    {
		$filesize = filesize($source);
		$length = strlen(gzdeflate($message, self::DEFLATE_LEVEL));
		
		$fps = fopen($source, 'r');
		
		fseek($fps, ($filesize - $length));
		
		$result = fread($fps, $filesize);
		$result = gzinflate($result);
		
		var_dump($result);
		
		fclose($fps);
		
		return $result;
	}
	
}