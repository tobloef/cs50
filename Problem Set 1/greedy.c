#include <stdio.h>
#include <string.h>
#include <math.h>
#include <cs50.h>

int getCentsOwed();
void printStepsNeeded(int owed);

//Define the four coins and their value
int coins[4] = {25, 10, 5, 1};

int main(void) {
	printStepsNeeded(getCentsOwed());
  	return 0;
}

//Get the number of cents owed
int getCentsOwed() {
	float owed;
	//Ask the user how much is owed until a non-negative float is entered
	do {
		printf("How much change is owed?\n");
		owed = GetFloat();
	} while (owed < 0);
	//Convert the amount owed to cents
	int cents = round(owed * 100);
	return cents;
}

void printStepsNeeded(int owed) {
	int steps = 0;
	//For each coints, starting with the largest, use as many of that coin as possible.
	for (int i = 0; i < 4; i++) {
		//Remainder after giving as many of the current coin as possible
		int remainder = owed % coins[i];
		//Number of cents just given divided by the current coin value equals the number of coins (steps) given.
		steps += (owed - remainder) / coins[i];
		owed = remainder;
	}
	//Print the number of steps used
	printf("%d\n", steps);
}
