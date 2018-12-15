<?php

if (! function_exists('now')) {
    /**
     * Create a new Carbon instance for the current time.
     *
     * @param  \DateTimeZone|string|null $tz
     * @return \Illuminate\Support\Carbon
     */
    function now($tz = null)
    {
        return \Illuminate\Support\Carbon::now($tz);
    }
}
if(!function_exists('loader')){
	function loader(...$variabel):object
	{
		return My\Load::file(...$variabel);
	}
}

(new Dotenv\Dotenv(__DIR__ .'/../../'))->load();
class_alias('My\DB','DB');
class_alias('My\Route','Route');
class_alias('My\Cache','Cache');
class_alias('Illuminate\Support\Carbon','Carbon');