<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class HostOrIpRule implements Rule
{
    protected const IP_REGEX = '/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/';
    protected const HOST_REGEX = '/^(([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])$/';

    protected $pingPort;

    public function __construct(?int $pingPort = null)
    {
        $this->pingPort = $pingPort ?? config('keys.default_pint_port');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (preg_match(self::HOST_REGEX, $value) || preg_match(self::IP_REGEX, $value)) && $this->ping($value);
    }

    public function ping($host)
    {
        try {
            $fp = fsockopen($host, $this->pingPort, $errorCode, $errorCode, 5);
            if ($fp === false) {
                return false;
            }
            fclose($fp);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be valid host or ip address.';
    }
}
