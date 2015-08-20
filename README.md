# TooLateBingo
Does your co-worker turn up late to work every now and then? Don't worry and play Too Late Bingo!

This PHP script lets you create random bingo cards.

## Parameters:
 -p (players: 1)
 -w (width of the square: 5)
 -s (starting number: 1)
 -m (max numbers: 99)
 
## Usage
run `php index.php`

result:
```
+--+--+--+--+--+
|45|62|19|21|11|
+--+--+--+--+--+
|75|57|89|26| 1|
+--+--+--+--+--+
|28|31|39|23|81|
+--+--+--+--+--+
|24|72|84|42|10|
+--+--+--+--+--+
|52|76|43|14|32|
+--+--+--+--+--+
```

run `php index.php -p2 -w4 -s10 -m50`

result:
```
+--+--+--+--+
|25|36|33|31|
+--+--+--+--+
|13|11|32|16|
+--+--+--+--+
|28|45|21|42|
+--+--+--+--+
|48|12|35|17|
+--+--+--+--+

+--+--+--+--+
|37|50|30|35|
+--+--+--+--+
|24|48|20|43|
+--+--+--+--+
|22|31|12|47|
+--+--+--+--+
|29|41|25|44|
+--+--+--+--+
```

## One month bingo

Let's say you and your co-worker want to start the 4th of the month and play until the end (31st) with a field of three rows wide, just run:

```
run `php index.php -p2 -w3 -s4 -m31`
```
