#include <stdio.h>
#include <string.h>
#include <ctype.h>
#include <cs50.h>

void printInitials();

int main(void) {
	printInitials();
  	return 0;
}

void printInitials() {
	string name;
	//Ask the for the users name until a non-empty string is given
	do {
		//printf("Name: ");
		name = GetString();
	} while (strlen(name) == 0);
	printf("%c", toupper(name[0]));
	//For each character in the name
	for (int i = 1; i < strlen(name); i++) {
		//If the character is a space, assume the previous letter should be part of the initials
		if (name[i] == 32) {
			printf("%c", toupper(name[i+1]));
		}
	}
	printf("\n");
}
