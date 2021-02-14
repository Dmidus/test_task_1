-module (test).
-export ([calc/1]).

calc({multiply, A, B}) -> 
    {ok, A * B};
calc({divide, _, 0}) ->
    {error, "zero"};
calc({divide, A, B}) -> 
    {ok, A / B}.