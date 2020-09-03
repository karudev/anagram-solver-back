<?php

namespace App\Service;


class AnagramSolverService
{

    /**
     * @param string $a
     * @param string $b
     * @return null
     */
    public function run(string $a, string $b)
    {
        # if string has not the same number of caracters, return -1
        if (strlen($a) !== strlen($b)) {
            $p = -1;
        } else {
            # if string is the same, do nothing and return 0
            if ($a === $b) {
                $p = 0;
            } else {
                # else, let's try to find the number of rearrangement
                $aArray = str_split($a);
                $bArray = str_split($b);

                $p = -1;

                # [a] : loop letter by letter
                foreach ($aArray as $aKey => $aLetter) {

                    $initialLetterPosition = null;
                    $newLetterPosition = null;


                    foreach ($bArray as $bKey => $bLetter) {

                        # [b] : loop letter by letter and find the letter to rearrangement
                        if ($aKey != $bKey && $aLetter === $bLetter) {

                            # save initial and new position
                            $initialLetterPosition = $aKey;
                            $newLetterPosition = $bKey;

                            # save number of rearrangement
                            $p = $newLetterPosition - $initialLetterPosition;
                        }
                    }

                    # verify if the reorder is ok, and let's go out.
                    if ($p !== -1 && $this->reorder($aArray, $initialLetterPosition, $newLetterPosition) === $b) {
                        break;
                    }
                }
            }

        }


        return $p;
    }

    /**
     * Reoder a string with the initial and the new position to change
     * @param $stringIntoArray
     * @param $initialLetterPosition
     * @param $newLetterPosition
     * @return string
     */
    private function reorder($stringIntoArray, $initialLetterPosition, $newLetterPosition)
    {
        $cloneStringIntoArray = $stringIntoArray;

        foreach ($stringIntoArray as $key => $letter) {
            if ($key === $initialLetterPosition) {
                for ($i = 1; $i <= ($newLetterPosition - $initialLetterPosition); $i++) {
                    $cloneStringIntoArray[$newLetterPosition - $i] = $stringIntoArray[$newLetterPosition - ($i - 1)];
                }
                $cloneStringIntoArray[$newLetterPosition] = $letter;

            }
        }

        return implode($cloneStringIntoArray);
    }

}