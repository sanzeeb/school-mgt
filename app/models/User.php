<?php

use Illuminate\Auth\UserInterface;


class User extends Eloquent implements UserInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	public function getRememberToken()
	{
		// declarations
	}

	public function setRememberToken($value)
	{
		// declarations
	}

	public function getRememberTokenName()
	{
		// declarations
	}

    /**
     * @var array  only attributes that can be fill-able
     */
    protected $fillable = array('username','user_type','password');

}