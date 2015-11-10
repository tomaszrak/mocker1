<?php
/**
 * Created by PhpStorm.
 * User: kgurgul
 * Date: 2015-10-12
 * Time: 21:07
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="header")
 */
class Header
{
    /**
     * @ORM\Column(type="integer", name="headerId")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, name="headerKey")
     */
    protected $headerKey;

    /**
     * @ORM\Column(type="string", length=100, name="headerValue")
     */
    protected $headerValue;

    /**
     * @ORM\ManyToOne(targetEntity="Mock", inversedBy="headers", cascade={"persist"})
     * @ORM\JoinColumn(name="mockId", referencedColumnName="mockId", nullable=true)
     **/
    protected $mock;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get mock
     *
     * @return \AppBundle\Entity\Mock
     */
    public function getMock()
    {
        return $this->mock;
    }

    /**
     * Set mock
     *
     * @param \AppBundle\Entity\Mock $mock
     *
     * @return Header
     */
    public function setMock(\AppBundle\Entity\Mock $mock = null)
    {
        $this->mock = $mock;

        return $this;
    }

    /**
     * Get headerKey
     *
     * @return string
     */
    public function getHeaderKey()
    {
        return $this->headerKey;
    }

    /**
     * Set headerKey
     *
     * @param string $headerKey
     *
     * @return Header
     */
    public function setHeaderKey($headerKey)
    {
        $this->headerKey = $headerKey;

        return $this;
    }

    /**
     * Get headerValue
     *
     * @return string
     */
    public function getHeaderValue()
    {
        return $this->headerValue;
    }

    /**
     * Set headerValue
     *
     * @param string $headerValue
     *
     * @return Header
     */
    public function setHeaderValue($headerValue)
    {
        $this->headerValue = $headerValue;

        return $this;
    }
}
