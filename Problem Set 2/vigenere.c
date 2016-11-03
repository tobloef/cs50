#include <stdio.h>
#include <string.h>
#include <ctype.h>
#include <cs50.h>

void printEncrypted(string k, string str);

int main(int argc, string argv[]) {
	//Make sure only one argument has been passed
	if (argc == 2) {
		//Test whether all characters in the argument is alphabetic
		for (int i = 0; i < strlen(argv[1]); i++) {
			//If not, yell at the user and return 1
			if (!isalpha(argv[1][i])) {
				printf("Keyword must be only A-Z and a-z.\n");
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
		printEncrypted(argv[1], plainText);
	//If not, yell at the user and return 1
	} else {
		printf("Usage: ./vigenere <key>\n");
		return 1;
	}
  	return 0;
}

void printEncrypted(string k, string str) {
	int j = 0;
	//Store the length of the key and the input string for later use
	//No need to calculate the string multiple times in the same loop
	int l = strlen(str);
	int keyLength = strlen(k);
	for (int i = 0; i < l; i++) {
		//If the character is an uppercase letter
		if (str[i] >= 65 && str[i] <= 90) {
			printf("%c", ((str[i] + tolower(k[j]) - 162) % 26) + 65);
		//If the character is an lowercase letter
		} else if (str[i] >= 97 && str[i] <= 122) {
			printf("%c", ((str[i] + tolower(k[j]) - 194) % 26) + 97);
		//If the character is non-alphabetic
		} else {
			printf("%c", str[i]);
		}
		//If the character is alphabetic, advance the key by one
		if (isalpha(str[i])) {
			j = (j + 1)%keyLength;
		}
	}
	printf("\n");
}
