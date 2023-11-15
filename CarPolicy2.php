<?php
class CarPolicy {
    private $policyNumber;
    private $yearlyPremium;
    private $dateOfLastClaim;

    public function __construct($policyNumber, $yearlyPremium) {
        $this->policyNumber = $policyNumber;
        $this->yearlyPremium = $yearlyPremium;
        $this->dateOfLastClaim = null;
    }

    public function setDateOfLastClaim($date) {
        $this->dateOfLastClaim = $date;
    }

    public function getTotalYearsNoClaims() {
        if (!$this->dateOfLastClaim) {
            return 0;
        }
        $currentDate = new DateTime();
        $lastDate = new DateTime($this->dateOfLastClaim);
        $interval = $currentDate->diff($lastDate);
        return $interval->format("%y");
    }
    
    public function getDiscount() {
        $yearsNoClaims = $this->getTotalYearsNoClaims();
        if ($yearsNoClaims > 5){
            return 0.15; 
        } elseif ($yearsNoClaims >= 3) {
            return 0.10;
        } else {
            return 0;
        }
    }
    
    public function getDiscountedPremium() {
        $discount = $this->getDiscount();  // Added missing semicolon
        return $this->yearlyPremium - ($this->yearlyPremium * $discount);
    }
   
    public function __toString() {
        return $this->policyNumber . ': ' . 'Unknown';
    }
}
?>