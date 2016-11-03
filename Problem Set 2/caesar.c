#include <stdio.h>
#include <string.h>
#include <ctype.h>
#include <cs50.h>

void printEncrypted(int k, string str);

int main(int argc, string argv[]) {
	//Make certain only one argument has been passed and that the number is non-negative.
	//If the argument isn't a number atoi will return 0 anyway. Checking whether the argument
	//was a number can therefore wait, thus saving us a few lines of code.
	if (argc == 2 && atoi(argv[1]) >= 0) {
		//Test whether all characters in the argument is a digit
		for (int i = 0; i < strlen(argv[1]); i++) {
			//If not, yell at the user and return 1
			if (!isdigit(argv[1][i])) {
				printf("Key must be a non-negative integer.\n");
				return 1;
			}
		}
		//Loop until the user enter a non-empty string.
		//The user should normally be notified that a wrong string was entered,
		//but according to check50, this is not allowed.
		string plainText;
    	do {
        	plainText = GetString();
    	}
   		while (strlen(plainText) == 0);
   		//Encrypt the string
		printEncrypted(atoi(argv[1]), plainText);
	//If not, yell at the user and return 1
	} else {
		printf("Usage: ./caesar <key>\n");
		return 1;
	}
  	return 0;
}

//Takes an integer k and use Caesar's cipher to encrypt a string.
void printEncrypted(int k, string str) {
	for (int i = 0; i < strlen(str); i++) {
		//If the character is an uppercase letter
		if (str[i] >= 65 && str[i] <= 90) {
			printf("%c", ((str[i] - 65 + k) % 26) + 65);
		//If the character is a lowercase letter
		} else if (str[i] >= 97 && str[i] <= 122) {
			printf("%c", ((str[i] - 97 + k) % 26) + 97);
		//If the character is non-alphabetic
		} else {
			printf("%c", str[i]);
		}
	}
	printf("\n");
}
