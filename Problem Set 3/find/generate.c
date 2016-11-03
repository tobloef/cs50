/***************************************************************************
 * generate.c
 *
 * Computer Science 50
 * Problem Set 3
 *
 * Generates pseudorandom numbers in [0,LIMIT), one per line.
 *
 * Usage: generate n [s]
 *
 * where n is number of pseudorandom numbers to print
 * and s is an optional seed
 ***************************************************************************/
 
// standard libraries
#define _XOPEN_SOURCE
#include <cs50.h>
#include <stdio.h>
#include <stdlib.h>
#include <time.h>

// constant
#define LIMIT 65536

int main(int argc, string argv[]) {
    // If anything but 2 or 3 arguments was given
    if (argc != 2 && argc != 3) {
        printf("Usage: generate n [s]\n");
        return 1;
    }

    // Convert the first argument to an integer and store it as n
    int n = atoi(argv[1]);

    // If a third argument was supplied, use it as a seed for the random number generator
    // Else use the current time as a seed
    if (argc == 3) {
        srand48((long int) atoi(argv[2]));
    }
    else {
        srand48((long int) time(NULL));
    }

    // Generate n amount of random positive integers bewteen 0 and LIMIT.
    for (int i = 0; i < n; i++) {
        printf("%i\n", (int) (drand48() * LIMIT));
    }

    // success
    return 0;
}