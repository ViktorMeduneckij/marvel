<?php

namespace AppBundle\Entity;

/**
 * Comic
 */
class Comic
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $comicId;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $pageCount;

    /**
     * @var string
     */
    private $coverPath;

    /**
     * @var string
     */
    private $coverExtension;

    /**
     * @var string
     */
    private $creators;

    /**
     * @var array
     */
    private $characters;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Comic
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set comicId
     *
     * @param integer $comicId
     *
     * @return Comic
     */
    public function setComicId($comicId)
    {
        $this->comicId = $comicId;

        return $this;
    }

    /**
     * Get comicId
     *
     * @return int
     */
    public function getComicId()
    {
        return $this->comicId;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Comic
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set pageCount
     *
     * @param integer $pageCount
     *
     * @return Comic
     */
    public function setPageCount($pageCount)
    {
        $this->pageCount = $pageCount;

        return $this;
    }

    /**
     * Get pageCount
     *
     * @return int
     */
    public function getPageCount()
    {
        return $this->pageCount;
    }

    /**
     * Set coverPath
     *
     * @param string $coverPath
     *
     * @return Comic
     */
    public function setCoverPath($coverPath)
    {
        $this->coverPath = $coverPath;

        return $this;
    }

    /**
     * Get coverPath
     *
     * @return string
     */
    public function getCoverPath()
    {
        return $this->coverPath;
    }

    /**
     * Set coverExtension
     *
     * @param string $coverExtension
     *
     * @return Comic
     */
    public function setCoverExtension($coverExtension)
    {
        $this->coverExtension = $coverExtension;

        return $this;
    }

    /**
     * Get coverExtension
     *
     * @return string
     */
    public function getCoverExtension()
    {
        return $this->coverExtension;
    }

    /**
     * Set creators
     *
     * @param string $creators
     *
     * @return Comic
     */
    public function setCreators($creators)
    {
        $this->creators = $creators;

        return $this;
    }

    /**
     * Get creators
     *
     * @return string
     */
    public function getCreators()
    {
        return $this->creators;
    }

    /**
     * Set characters
     *
     * @param array $characters
     *
     * @return Comic
     */
    public function setCharacters($characters)
    {
        $this->characters = $characters;

        return $this;
    }

    /**
     * Get characters
     *
     * @return array
     */
    public function getCharacters()
    {
        return $this->characters;
    }
}

