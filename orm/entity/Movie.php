<?php 

namespace entity; 

Class Movie {

	protected $id;
	protected $title;
	protected $category;
	protected $duration;
	protected $income;

	public function getId()
	{
		return $this->id;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getCategory()
	{
		return $this->category;
	}

	public function getDuration()
	{
		return $this->duration;
	}

	public function getIncome()
	{
		return $this->income;
	}


	public function setId($id)
	{
		$this->id = $id;
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function setCategory($category)
	{
		$this->category = $category;
	}

	public function setDuration($duration)
	{
		$this->duration = $duration;
	}

	public function setIncome($income)
	{
		$this->income = $income;
	}

}