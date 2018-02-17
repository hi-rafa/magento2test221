<?php

namespace Footballexperience\Base\Api\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;

interface MatchInterface extends CustomAttributesDataInterface
{
    const TABLE       = 'fe_base_match';
    const ID          = 'id';
    const DATE        = 'date';
    const TIME        = 'time';
    const TEAM_HOME_ID = 'team_home_id';
    const TEAM_AWAY_ID = 'team_away_id';
    const STADIUM_ID = 'stadium_id';
    
    /**
     * Retrieve the date
     *
     * @return string
     */
    public function getDate();
    
    /**
     * Set date
     *
     * @param string $date
     * @return $this
     */
    public function setDate($date);
    
    
    /**
     * Retrieve the time
     *
     * @return string
     */
    public function getTime();
    
    /**
     * Set time
     *
     * @param string $time
     * @return $this
     */
    public function setTime($time);
    
    /**
     * Retrieve the team_home
     *
     * @return string
     */
    public function getTeamHome();
    
    /**
     * Set team_home
     *
     * @param string $teamHome
     * @return $this
     */
    public function setTeamHome($teamHome);
    
    
    /**
     * Retrieve the team_away
     *
     * @return string
     */
    public function getTeamAway();
    
    /**
     * Set team_away
     *
     * @param string $teamAway
     * @return $this
     */
    public function setTeamAway($teamAway);
    
    /**
     * Retrieve the stadium
     *
     * @return string
     */
    public function getStadium();
    
    /**
     * Set stadium
     *
     * @param string $stadium
     * @return $this
     */
    public function setStadium($stadium);
    
    
    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \Footballexperience\Base\Api\Data\MatchExtensionInterface|null
     */
    public function getExtensionAttributes();
    
    /**
     * Set an extension attributes object.
     *
     * @param \Footballexperience\Base\Api\Data\MatchExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\Footballexperience\Base\Api\Data\MatchExtensionInterface $extensionAttributes);
    
    
}