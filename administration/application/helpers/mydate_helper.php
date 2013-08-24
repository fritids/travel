<?php
/**
 * Converts LOCAL time to a GMT value when given a timezone and a timestamp
 *
 * Takes a Unix timestamp (in LOCAL TIME) as input, and returns
 * at the GMT value based on the timezone and DST setting
 * submitted
 *
 * @access    public
 * @param    integer Unix timestamp
 * @param    string    timezone
 * @param    bool    whether DST is active
 * @return    integer
 */    
function convert_to_gmt($time = '', $timezone = 'UTC', $dst = FALSE)
{            
    if ($time == '')
    {
        return now();
    }
    
    $time -= timezones($timezone) * 3600;

    if ($dst == TRUE)
    {
        $time += 3600;
    }
    
    return $time;
} 

?>