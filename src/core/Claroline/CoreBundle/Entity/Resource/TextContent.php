<?php
namespace Claroline\CoreBundle\Entity\Resource;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="claro_text_content")
 */
class TextContent
{
   /**
    * @ORM\Id
    * @ORM\Column(type="integer") 
    * @ORM\generatedValue(strategy="AUTO")
    */
    protected $id;
     
    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $version;
    
    /**
     * @ORM\ManyToOne(targetEntity="Claroline\CoreBundle\Entity\Resource\Text", inversedBy="contents", cascade={"persist"})
     * @ORM\JoinColumn(name="text_id", referencedColumnName="id")
     */
    protected $text;
    
   /**
    * @ORM\Column(type="string", nullable=false)
    */
    protected $content;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Claroline\CoreBundle\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    public function __construct()
    {
        $this->version = 1;
    }
    
    public function getId()
    {
        return $this->id;
    }
    public function getVersion()
    {
        return $this->version;
    }
    
    public function setVersion($version)
    {
        $this->version = $version;
    }   
    
    public function setText($text)
    {
        $this->text = $text;
    }
    
    public function getText()
    {
        return $this->text;
    }
    
    public function setContent($content)
    {
        $this->content = $content;
    }
    
    public function getContent()
    {
        return $this->content;
    }
    
    public function setUser($user)
    {
        $this->user = $user;
    }
    
    public function getUser()
    {
        return $this->user;
    }
}