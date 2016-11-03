/****************************************************************************
 * dictionary.c
 *
 * Computer Science 50
 * Problem Set 5
 *
 * Implements a dictionary's functionality.
 ***************************************************************************/

#include <stdbool.h>
#include <stdio.h>
#include <stdlib.h>
#include "dictionary.h"

#define MAX_CHARS 27
#define MAX_WORD_LENGTH 45

typedef struct node {
	struct node* children[MAX_CHARS];
	bool isWord;
} node;

node* root = NULL;
int count = 0;

/**
 * Returns true if word is in dictionary else false.
 */
bool check(const char* word)
{
    node* currentNode = root;
    
    int c;
    int i = 0;
    while ((c = word[i++]) != '\0') {
    	if (c >= 'A' && c <= 'Z') {
    		c += 32;
    	}
    	if ((c >= 'a' && c <= 'z') || c == '\'') {
    		int index;
    		if (c == '\'') {
    			index = MAX_CHARS - 1;
    		} else {
    			index = c - 'a';
    		}
    		if (currentNode->children[index] == NULL) {
    			return false;
    		} else {
    			currentNode = currentNode->children[index];
    		}
    	} else {
    		return false;
    	}
    	
    }
    return currentNode->isWord;
}

/**
 * Loads dictionary into memory.  Returns true if successful else false.
 */
bool load(const char* dictionary)
{
    FILE* file = fopen(dictionary, "r");
    if (file == NULL) {
    	return false;
    }
    
    root = malloc(sizeof(node));
    node* curNode = root;
    
    int c;
    while ((c = fgetc(file)) != EOF) {
    	if (c >= 'A' && c <= 'Z') {
    		c += 32;
    	}
    	if ((c >= 'a' && c <= 'z') || c == '\'') {
    		int index;
    		if (c == '\'') {
    			index = MAX_CHARS - 1;
    		} else {
    		 index = c - 'a';
    		}
    		if (curNode->children[index] == NULL) {
    			node* newNode = malloc(sizeof(node));
    			curNode->children[index] = newNode;
    			curNode = curNode->children[index];
    		} else {
    			curNode = curNode->children[index];
    		}
    	} else {
    		if (c == '\n') {
    			curNode->isWord = true;
    			curNode = root;
    			count += 1;
    		} else {
    			printf("return false");
    			return false;
    		}
    	}
    }
    fclose(file);
    return true;
}

/**
 * Returns number of words in dictionary if loaded else 0 if not yet loaded.
 */
unsigned int size(void)
{
	return count;
}

void unloadNode(node* currentNode) {
	if (currentNode != NULL) {
		for (int i = 0; i < MAX_CHARS; i++) {
			unloadNode(currentNode->children[i]);
		}
		free(currentNode);
	}
}

/**
 * Unloads dictionary from memory.  Returns true if successful else false.
 */
bool unload(void)
{
    unloadNode(root);
    return true;
}
