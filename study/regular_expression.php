<?php
/*
-------------------REGULAR EXPRESSION-------------------
1. basic elements
(1). limitation mark
mark one: {n} stands for certain times, depends on n. if there's more than one param, it will work from big to small.
EXAMPLE: 
a{3} stands for aaa, 1{4} stands for 1111, (\d){2} stands for (\d)(\d)
mark two: + stands for 1 or many
EXAMPLE:
expression:/1+/gi; string: 1111111, return 1111111;
expression:/a1+/gi; string: a11111, return a11111;
mark three: * stands for 0 or many
EXAMPLE:
expression: /a1/*/gi; string: a111, return a111;
mark four: ? stands for 0 or 1
EXAMPLE:
expression:/a1?/gi; string: a11111, return a1
expression:/a1?/gi; string: a21111, return a
(2). select match mark
mark example: |
HINT: when you need to select more than one element, you need to use | mark.
expression: /xxx|xxx/gi;
(3). grouping and reverse quoting mark.
(4). special mark
(5). string matching mark
mark example: [a-z] stands for any string from a to z.
mark example: [^a-z] stands for the oppisite above.
\d stands for [0-9]  \D stands for \d's oppistie [^0-9];
\w stands for [0-9a-zA-Z_] 
\W is the oppisite of \w stands for [^0-9a-zA-Z_]
\s matches any space string
\S matches any non-space string the oppisite of \s
.  matches any string except \n, if wanna match ., put \ in front it, show as "\."

(6). positioning mark
CONTAIN: * means start $ means end
(7). special symble need to use with '\'
CONTAIN: . * + () $ / \ ? [] ^ {}
HINT: when * means oppisite, it should be in [].