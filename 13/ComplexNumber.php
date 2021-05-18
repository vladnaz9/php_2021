<?php


class ComplexNumber
{
    public float $real, $image;

    public function __construct(float $real = 0, float $image = 0)
    {
        $this->real = (float)$real;
        $this->image = (float)$image;
    }

    public function __toString(): string
    {
        return $this->real . "+" . $this->image . "i";
    }

    /**
     * @return float|int
     */
    public function getIm()
    {
        return $this->image;
    }

    /**
     * @return float|int
     */
    public function getRe()
    {
        return $this->real;
    }

    public static function sum(ComplexNumber $cn1, ComplexNumber $cn2): ComplexNumber
    {
        return new ComplexNumber($cn1->getRe() + $cn2->getRe(), $cn1->getIm() + $cn2->getIm());
    }

    public static function multiply(ComplexNumber $cn1, ComplexNumber $cn2): ComplexNumber
    {
        return new ComplexNumber($cn1->getRe() * $cn2->getRe() - $cn1->getIm() * $cn2->getIm(), $cn1->getRe() * $cn2->getIm() + $cn1->getIm() * $cn2->getRe());
    }

    public static function subtract(ComplexNumber $cn1, ComplexNumber $cn2): ComplexNumber
    {
        return new ComplexNumber($cn1->getRe() - $cn2->getRe(), $cn1->getIm() - $cn2->getIm());
    }

    public static function divide(ComplexNumber $cn1, ComplexNumber $cn2): ComplexNumber
    {
        try {
            $temp = new ComplexNumber($cn2->getRe(), (-1) * $cn2->getIm());
            $temp = ComplexNumber::multiply($cn1, $temp);
            $denominator = $cn2->getRe() * $cn2->getRe() + $cn2->getIm() * $cn2->getIm();
            return new ComplexNumber($temp->getRe() / $denominator, $temp->getIm() / $denominator);
        } catch (Exception $e){
            throw $e;
        }

    }


    public function abs()
    {
        return sqrt($this->real * $this->real + $this->image * $this->image);
    }
}

