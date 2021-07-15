| **Title** |  Answers to technical questions                                       |  
|:--------------------|:----------------------------------------------------------------------|  
| **Date created** | 14<sup>th</sup> July 2021
| **Project** |  Shopworks recruitment technical test
| **Author** | Adel Kedjour
| **Version** | 0.1.0
| **Last updated** | 15<sup>th</sup> July 2021
| **Contact** | Adel Kedjour - akedjour@outlook.com
| **Description** | Shopworks recruitment technical code test
| **Copyright** | © 2021 Adel Kedjour

## Technical Answers

Please find the answers to all the questions as follows:

1. How long did you spend on the coding test? What would you add to your solution if you had more time?
    - I have spent around 2 hours (pen and paper) to find the right solution, and the right algorithm that has less complexity time; and around 3.5 hours to implement the solution and writing the necessary unit tests.
    - If I had more time I would do some refactoring try to extract some static functions to an appropriate class or classes, also I would write more tests to make sure I am covering the whole code (features).
    - What I was trying to do here is to have the simple and efficient solution and easy to ready and maintain, my main focus was to have the best complexity time of the algorithms, so I did used the quick sort `(usort() function in PHP)` to sort the shifts by starting time which
      is had complexity of `n log (n)` also I had to use some loops which 2 of them with complexity of `n` of each this will give me **total complexity:** `n log (n) + n + n ~= n log (n)` by removing the two `n` as they are not really adding nothing to our complexity, so we can
      just get rid of them, and we will end up by complexity of `n log (n)` which is the best what I can get in this exercise so far.

2. Why did you choose PHP as your main programming language?
    - For this test because is requirement, and the position for PHP Software Engineer
    - And I have chosen PHP as my main programming language because I had got involved in project years ago where I had to use PHP, so I had to lear it, and then with time it turns out that I loved it as it's easy to learn and been built using `C` and `Perl` and is because is a
      scripting language that is especially suited for web development and can be embedded into HTML.
    - Also, because is the most popular web development programming language, still dominating the web.

3. What is your favourite thing about your most familiar PHP framework (Laravel / Symfony etc)?
    - First, my favourite PHP framework is Laravel.
    - My favourite thing about Laravel, the simplicity and the elegant syntax pattern, secure authentication mechanism, schema builder and database migration tools, and many more exceptional features make Laravel the best among all PHP frameworks.
    - Blade (Template Engine), Artisan (CLI Command Tool), Eloquent ORM (object-relational mapping) are one of the best thing I like in Laravel
    - Also, the community is huge.
4. What is your least favourite thing about the above framework?
    - Honestly never thought about it, I never disliked something in Laravel as for me Laravel ad Framework is just boost, and most of the time I have to customize some stuff it's kind of lego you always need extra to build whatever you are building with the right and best way.   
