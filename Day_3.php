<?php

/*function map()
{
    $height = 11;

    $map = [];

    for ($h = $height; $h > 0; $h--) {

        $tmpRow = [];

        $width = 11;

        for ($w = $width; $w > 0; $w--) {
            $tmpRow[] = rand(1,0);
        }

        $map[] = $tmpRow;
    }

    return $map;
}
*/
function testMap()
{
    return [
        [0,0,1,1,0,0,0,0,0,0,0], // 0 
        [1,0,0,0,1,0,0,0,1,0,0], // 1 
        [0,1,0,0,0,0,1,0,0,1,0], // 2
        [0,0,1,0,1,0,0,0,1,0,1], // 3 
        [0,1,0,0,0,1,1,0,0,1,0], // 4
        [0,0,1,0,1,1,0,0,0,0,0], // 5
        [0,1,0,1,0,1,0,0,0,0,1], // 6
        [0,1,0,0,0,0,0,0,0,0,1], // 7
        [1,0,1,1,0,0,0,1,0,0,0], // 8
        [1,0,0,0,1,1,0,0,0,0,1], // 9
        [0,1,0,0,1,0,0,0,1,0,1], // 10
    ];
}

function collisions($map, $moveY, $moveX)
{
    //$map = testMap();
        
    // emulate initial moving $moveY down
    for ($i=$moveY; $i > 0; $i--) {

        // rEsPeCt 0 iNdEx
        unset($map[($i-1)]);

    }
    
    $y = 0;

    // emulate initial moving $moveX across
    $x = $moveX;

    $treeCollisions = 0;

    foreach ($map as $h => $row) {

        // emulate moving moveY down
        if ($h % $moveY == 0) {
            // check if we hit a tree 
            if ($row[$x] === 1) {

                $treeCollisions++;
                var_dump("HIT across {$x} down {$h}");
            } else {
                var_dump("miss across {$x} down {$h}");
            }

            // move across
            $x = $x + $moveX;

            // if at the end of width, reset back to start and maintain steps right for next iteration
            // respect 0 index vs count
            if ((count($row) -1 ) < $x) {

                $rowSize = count($row);

                $x = $x - $rowSize;
            }

            $y += $moveY;

            // if at the bottom stop execution and return collisions
            // respect 0 index vs count
            if ((count($map) - 1) < $y) {
                return $treeCollisions;
            }
        }            
    }
}


$map = '....##..#........##...#.#..#.##
.#.#..#....##....#...#..##.....
##.#..##..#...#..........##.#..
.#.##.####..#......###.........
#.#.#...........#.....#...#....
#.......#....#.#.##..###..##..#
.#...#...##....#.........#.....
..........##.#.#.....#....#.#..
.......##..##...#.#.#...#......
.#.#.#...#...##...#.##.##..#...
........##.#.#.###.........##..
#.#..#.#.#.....#...#...#......#
.#.#.#...##......#...#.........
.#..##.##.#...#...##....#.#....
.##...#..#..#......##.###....##
.....#...#.###.....#.#.........
#.##..#....#.#.#.#.............
........#...#......#...#..#....
##..##...##.##...#...#.###...##
#.#....##.#...###......#..#.#..
..#.....#.##......#..........#.
#.......#..#......#.....#....#.
.....###...........#....#.##...
#.#........##.......#.#...#.##.
.#.#.#........#........#.#.....
#..#..##.....#.###..#.#.#.##..#
..#.#...#..##.#.#.#.......###..
........#........#..#..#...#...
##............#...#..##.##...#.
#....#.#.....##...#............
............#...#..#.#.#....#..
#.#.#...##.##.#....#....#......
................###.....#.....#
##.#####.#..#...###..#...###...
...#.....#...#.#....#...#..#...
.......#....##.##.#.##.........
..#..#..##.....#...#.#.....#...
...#...#.#.##.#..###.......#...
...#...........#.#####..##..#..
#.#...#........####..#......#.#
#..#.##...........#.#......#.##
#.#..#....##..#..##.#..........
.....#..#.....#........##..#...
...###.......#.##.......#......
...##..#..#...#....#.###...#...
....####....#........#.##.#.#.#
#....#.....#.###.##...##..##.##
.##.#...#.##.#......#..##.#....
...#.............#.............
..##..##.#.....#........##....#
#.....#....#.......####...#..#.
..#...#..#...#...##.#....##....
.#...##....#....#..#....#......
##..#.#...##......#..#.......##
..#...#.##..#.....#.#...#..#.#.
#..##....#..........#..........
.#........#..#......#......#.#.
...##.#.........#.#....#.#...#.
#.....#.#..#...#...#..#...#...#
#.........#.#.........##.......
.#.......#......#.........###..
.#..#..##...........#.....#..#.
.#....................#.....#..
.##.....#....#....#.###.....#..
...##.#.....#.#....#.........#.
.........##.....#.....#.##..#..
......#......#.#..#..###...#..#
..##...#.#..#...#.#....#.......
..#..##.###.#..#..#..#......#..
.....##...##.........#...##...#
###.#..##....##...##.#..###....
#...#.#..##......##...#.#..#...
..........#....###....#........
#.#.#.#.#.....#..##.##.....#...
.##.....#...#.....#......#.....
.#..........#.#.............#..
.#..##..#.#..##...#....#.##...#
..#.#..........#...#..........#
.#.......#.......#...#..#.....#
##.#...##...#......#.#..#......
#####..#....#..#...#...#.#.....
....#.......#.#..#.............
#..#..#.#.####...#....#....##..
#..#.##.#......#...#......#....
#...##.##...#....#..........##.
..#..#.......##.#....#...#.#...
.....#.##..............##.....#
..##.##...##.....#.........#.#.
.#....##...##...##..#....##..#.
.#...#....#..#......#.#........
#....#.#.#..............#....##
..##..#..#....#####.#....#.#.##
#....#...#.##..#.##.........###
#..#..#....#...............#.#.
#....##...##........##.##.#.##.
......#......##....##.....#.###
#...##..#..#.....#.#........##.
..#.#.##...#...#....#..###...#.
#..##..#.###..##.#.#....#......
..###..#.##........###.....#...
#.............#.............#..
.#.##....#..##.#...#....#.#####
###.....###.#......##..#..##...
.#.#......##.#....#....#.#..#..
###..#..#....#......###.##.....
......#.......#......#..##..##.
..#..#...#..#....#.##....#.#..#
.......##..#........#.#.##.....
.#...#..#........#..#.#..#..#.#
.#..#.##.......#......#...#.#..
.##..##......##.#...#......####
.....#....#......#.....#......#
..........#.#.#...##.#..#.#....
...#.......##......#..#.#.##...
.###..#.#.#....................
##...#...#.##............#.....
....#....#.##...#..#.#...##....
..#.#....#.###...#...#.#.####.#
..#..#.#...#.#......##.........
#..#..####.##.#.#..###....#...#
....#..........#.##.#..#.#.#.#.
#.#.##.........#.....##...#..##
#......#...#.##.#......#..#.#..
#...#........#..#..#...##...#..
.....#.####..##..#.#.##..#...#.
#..#........#........#...#....#
...........#..#.....#.#.#.#....
....#......#....#...#....##....
.#.#..#...#.#....#..#.#....##.#
....#...#...#.##..#...#..##...#
#######...............##.....##
.#.#..............#....#..#.###
#......#.#......###....###.....
##..#...#.##..##..##.#....#....
#....##..#..#...#.#.#...#......
..........#..#.##..##.##.#..##.
....#.#.#.....##........#..#...
..###...#.....##.##.....##..##.
....#.#..#.#.......#.......#...
..##.#..#.....##...###...#...#.
..#.........#...##...#...#..#..
..#..#..#..#..##.#...##..#.#...
...##..#..##..#..####...#.....#
............#............###...
.#.#.###.#.....#.#.#..#.###..#.
...#.........#.....####........
....##.#..##.#.............#...
....#.##.....#..#.....#......##
..........#.............#...##.
#..#.....#.......##..###.......
..##.#...........#.......#..#..
...#...#.#.##.###....#.#..#....
...#..........##..#..#..#...###
.........#.....#..##.....#..#..
#........#...#...#..#.#....##..
.#.#.....####..#.##.#..........
###.......##..#.##...#.....#...
..###.##.#..#..#..#.....##...#.
.........#.....##.#..#..##.....
#..#..##...###..............#..
#....#.#....#..#.....#..####...
####..#.....##...#..#.#.#.#...#
...#....#.....#.##.#.#.#....##.
..........#...#.....###....#.##
#....#.#.#....#..#..#.....#....
.....#.#...#......#....#......#
.####....##...#...#......##..#.
.#...#..#....#..#..............
##.#...##...#.##..#......#.....
..####.##..#....#.#......#.#.##
........#.....##...#.#..##....#
....#.#.#.#.###...#.#...##...##
#.....#...####.#....#.#........
..#.....#...##.........###.....
....#....#....#..#......#####.#
###.....#..#.#.#......#.##.#...
....#.##......#..#.#...........
.#....#....#.#..#.......#...##.
...................#.#.#..#....
##...#.....#........#....#...#.
........##......#...##.#..#.#.#
#.#..###...#....#.#...#.......#
#..........##......#..#..#.....
.............#...##.#...#......
#..#....##..#.........#..#.###.
.....#..........#....##.#...##.
###....................#.#.##..
#........##...##......#....###.
#....#.............#....#...#..
##.......##.#.......#....#..#..
##...#............#..#.#....##.
..#.#..#...#####..........#....
..#.........##.....#.#...####..
....#..............#...........
..#...#.#.#..#.......##.#.#.#..
....#.##.....##..#.....#..####.
#...#...#...#.......#.........#
......#..#.####...###.#.#.....#
.......#..#..#.....#.#..##.#..#
.#......##..#............#.....
.#........#.#....#....#........
.....#.#..#.##.#..##....#..#...
#.#...........#....##.....#....
..#..#..##.###..##..#..###.#.##
##.#..#...##.#.........#...#.#.
......#..#..##...#....#...#.##.
#.##.......................#...
.......#..#..#.##..##......#...
..#.#...#.....#..###....#...#..
##..#.....#..#..#.##.....#...##
#...##...###...#.#..###....#...
...#.#.#..####.....#...##....#.
.#.#..##.....#..#.....##..##..#
#...#..........#.##.#.#........
..##....#.##....#..##......#...
....#..........###.....####..##
...........###....##.#.#.#.#...
...#......................####.
#.#.#...#.#.#.#.#......#.....##
..###...#.####...#..##..#....#.
....#....#.......#...#.........
.#.###.............##..#...#...
....#.#....##...#.....#.##.....
#.......##.....#.#.....#....##.
....##.....###..#.#..#....#...#
......#..##...#......#.....#.##
.#.....#.##.###....#.....#..###
...#..#.###.#....#..#..#...##.#
...##..#...#..#.#.#..#...#.....
##.####...##..#.#.#....#.......
..##..#.#.......##.#......##.#.
....##....#....#..#....#..##.#.
..##..........##....#...#.#..#.
#.#...#.#.###.#.#..##.#...#....
.....#..#.............#...#...#
....#.#..#...##...#....#.##....
#..#...#.###.....#...#.....#.#.
#####....#....#....#.......#.##
#...##....##.#.#...#.....##.#..
#.......#...#..#..#...#....#...
....#......#.#..........#....##
#.###...#.#..##..#.##........#.
#..#.....##.......#..#..#.#....
...#...#.##...#....#.#.#.#...#.
...##..#.#....#......###......#
#.#....#...#..#..#....#........
..#..#.#...##..........#.###...
#..........#...#..#....#....###
..#..#.#....#..............#...
...#........#...#.#....###.#..#
....#.#.#................#..#.#
..#........##.#....#.#..#......
...##..#..#.......#..#......#.#
..#..#....#.........#....#.##..
#.....#....###.#..#..#...#...#.
..#..##.###.#..##....#.###.....
...#...####..#........###.#....
.........#.#...#..#..#.#.......
.##.........##.#..............#
..#.#.#.....###........#.#.#..#
....##..#....#....#.#..#.......
#.#.....#...#........##........
.##.#.#..#..#.#.#.........#....
#.....#..#.##...#...#..........
##..#....#....##.#..#.........#
................#.##.#......#.#
..#..#.#........##...###..#...#
##........#.......#...##.##..#.
##....#.....#..##....#.......#.
#.#....#.#........#..#.........
......##......#...#.....#.##...
###....#..........##.#.#......#
......#...###.........###..#...
.####....#...##..#.#.....#...#.
.##...#...###....#...#.#..###..
#..#......##...#.###..###...#..
#....#.#.#..#....##...#.##..#..
..#.....#...#..........#.##.###
#.....#....###.......##..##.#..
#..##...#..#....#.###......#...
#..#........##..#.....#.#.#....
#.##.#.#..#....#.#.............
.#...............#....##.......
.#.##......##........#...#..#.#
.#...#....#....#...#..#...##...
.....#..###...##........#.#....
...#.......#....##..#..#....#..
...###....#........#..#.###.#..
......##..##..............###.#
.......#.####..##....#.#....#..
#...#......#...#..#.....##....#
.#..#..###....#..##.##.#.......
#......##......#..##....#..##..
.....#..#.#......##.##..##.....
...#..#.......#......#.........
....#..####......#..#....#...#.
..#.#..#...#....#....#.......#.
####..#........#.###...##.#.#.#
.......##........#.#.#...##....
...#.........#..#.#..##....#...
.....#..#...#.#....#...#.#.##.#
#..##.....#.....##.......#...#.
.......##.#.#.....#....#......#
...#...#.##...#......#....#....
..#..#.#...#..#.....#...###.#..
.........#...#..#.......##.....
..##...................#..#.###
.##.##..#.#...#.#....#.....##..
#.#...##...#...#...##..#......#
....#..#...#.....##.#.....#..##
##.#..........###..#...#..#....
...##....#.##....#......#......
.....#.........#....#.#.......#
.......#............#.#.....#..
..#..#...#..#####..#....##.....
...##......##...#.#........##..
.....#..###...##.#.#.##.#...#..
..#.#.#..##..#.##...##.#.#.....
......##...#..##......#.#......
......................#........
#...#..#....#..#.#.##.#.....#.#
.#......#.#....#.#.#..#....#...
.#..#.#.#..#....#..............
';

// get rows into their own arrays
$rows = preg_split('/\r\n|\r|\n/', $map);

// remove empty row on end
array_pop($rows);

// prep holder for actual map that function understands
$map = [];

foreach ($rows as $stringRow) {
    
    // turn into array
    $row = str_split($stringRow);

    // tmp holder for row
    $tmpRow = [];

    foreach ($row as $bool) {

        if ($bool == ".") {

            $tmpRow[] = 0;
        // don't really need else if but readability and such
        } else if ($bool == "#") {

            $tmpRow[] = 1;
        }
    }

    $map[] = $tmpRow;
}

var_dump(collisions($map, 1 ,5));

/**
 * x1 - y1 = 93
 * x3 - y1 = 164
 * x5 - y1 = 
 * x7 - y1 = 91
 * x1 - y2 = 44
 * 
 * tHrOw ThEm AlL tOgEtHeR
 * 164 * 93 * 91 * 44 * 82 = 5007658656
 */
