/**
 * helpers.c
 *
 * Computer Science 50
 * Problem Set 3
 *
 * Helper functions for Problem Set 3.
 */
       
#include <cs50.h>

#include "helpers.h"

/**
 * Returns true if value is in array of n values, else false.
 */
bool search(int value, int values[], int n) {
    int low = 0;
    int high = n - 1;
    while (low <= high) {
    	int mid = (low + high) / 2;
    	if (values[mid] > value) {
    		high = mid - 1;
    	} else if (values[mid] < value) {
    		low = mid + 1;
    	} else {
    		return true;
    	}
    }
    return false;
}

/**
 * Sorts array of n values.
 */
void sort(int values[], int n) {
	for (int i = 0; i < n; i++) {
		bool swapped = false;
		for (int k = 0; k < n; k++) {
			if (values[k] < values[k-1]) {
				int tmp = values[k];
				values[k] = values[k-1];
				values[k-1] = tmp;
				swapped = true;
			}
		}
	}
    return;
}