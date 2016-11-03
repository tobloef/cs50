#include <stdio.h>
#include <string.h>
#include <cs50.h>

int getHeight();
void printPyramid(int size);

int main(void) {
	printPyramid(getHeight());
  	return 0;
}

int getHeight() {
	int input;
	//Ask the user for a height until an integer between 0 and 23 is entered
	do {
		printf("Height: ");
		input = GetInt();
	} while (input > 23 || input < 0);
	return input;
}

void printPyramid(int size) {
	int i, j, k;
	for (i = 0; i < size; i++) {
		//Print the appropriate amount of spaces
		for (j = 0; j < size-i-1; j++) {
			printf(" ");
		}
		//Then the pound signs
		for (k = 0; k <= i+1; k++) {
			printf("#");
		}
		printf("\n");	
	}
}
