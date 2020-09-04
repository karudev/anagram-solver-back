<?php

namespace App\Service;


class AnagramSolverService
{

    /**
     * @param string $a
     * @param string $b
     * @return int
     */
    public function run(string $a, string $b)
    {
        # No sensitive case
        $a = strtolower($a);
        $b = strtolower($b);

        $totalP = 0;

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

                $calculateAndReturnNewWord = function (&$aArray, &$p, &$totalP) use ($b, $bArray) {
                    # [a] : loop letter by letter
                    foreach ($aArray as $aKey => $aLetter) {

                        $initialLetterPosition = null;
                        $newLetterPosition = null;

                        foreach ($bArray as $bKey => $bLetter) {
                            # [b] : loop letter by letter and find the letter to rearrangement

                            if ($aKey === $bKey && $aLetter === $bLetter) {
                                # do nothing, it's ok for this letter
                                break;
                            } elseif ($aKey !== $bKey && $aLetter === $bLetter) {
                                # else, let's try to set the letter in the good position and save the new word

                                # save initial and new position
                                $initialLetterPosition = $aKey;
                                $newLetterPosition = $bKey;

                                # save number of rearrangement
                                $p = $newLetterPosition < $initialLetterPosition ? 0 : $newLetterPosition - $initialLetterPosition;
                                $totalP += $p;

                                $newStringToArray = $this->reorder($aArray, $initialLetterPosition, $newLetterPosition, false);

                                # build new word for the newt loop
                                foreach ($newStringToArray as $nsKey => $nsLetter) {
                                    $aArray[$nsKey] = $nsLetter;
                                }

                                if ($p > 0) {
                                    # go to reloop on the new word
                                    return true;
                                }
                            }
                        }

                        # verify if the reorder is ok, and let's go out.
                        if ($p !== -1 && $this->reorder((array)$aArray, $initialLetterPosition, $newLetterPosition) === $b) {
                            break;
                        }
                    }
                };

                while ($calculateAndReturnNewWord($aArray, $p, $totalP)) ;

            }

        }


        return $p != -1 ? $totalP : $p;
    }

    /**
     * Reoder a string with the initial and the new position to change
     * @param array $stringIntoArray
     * @param int|null $initialLetterPosition
     * @param int|null $newLetterPosition
     * @param bool $outputToString
     * @return array|string
     */
    private function reorder(array $stringIntoArray, int $initialLetterPosition = null, int $newLetterPosition = null, $outputToString = true)
    {

        $cloneStringIntoArray = $stringIntoArray;

        if($initialLetterPosition !== null && $newLetterPosition !== null) {
            foreach ($stringIntoArray as $key => $letter) {
                if ($key === $initialLetterPosition) {
                    for ($i = 1; $i <= ($newLetterPosition - $initialLetterPosition); $i++) {
                        $cloneStringIntoArray[$newLetterPosition - $i] = $stringIntoArray[$newLetterPosition - ($i - 1)];
                    }
                    $cloneStringIntoArray[$newLetterPosition] = $letter;

                }
            }
        }

        return $outputToString ? implode($cloneStringIntoArray) : $cloneStringIntoArray;
    }

}