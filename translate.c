#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include <errno.h>
#include "translate.h"
//#include <glib.h>


char * get_line(FILE * f, char * buf){
  return fgets(buf, BUF_SIZE, f);
}

void rm_return(char * s){
  int i;
  for (i = 0; s[i] != '\0' ; i++)
    if(s[i] == '\n') s[i] = '\0';
}

void translate(char * pn){
  FILE * f = fopen(pn,"r+");
  char tmp[BUF_SIZE];
  char cmd[TXT_SIZE];
  couple * c;
  while (get_line(f,tmp)){
    rm_return(tmp); //remove '\n'  '\0'
    c = is_alias(tmp);
    if (c){
      sprintf(cmd,"sed -i '/%s/d' %s",tmp,pn);
      //printf("%s\n",cmd);
      system(cmd);
      sprintf(cmd,"sed -i 's/%s/%s/g' %s",c->alias,c->txt,pn);
      //printf("%s\n",cmd);
      system(cmd);
      free(c->alias);
      free(c->txt);
    }
  }
}


char * jump_space(char * s){
  int i = 0;
  while(s[i] == ' ') i++;
  return &s[i];
}

char * save (char * s){
  char * ret = malloc(TXT_SIZE);
  int i = 0;
  while(s[i] != ' ' && s[i] != '\n' && s[i] != '\0'){
    ret[i] = s[i];
    i++;
  }
  ret[i] = '\0';
  return ret;
}

couple * is_alias(char * line){
  char * ou = strstr(line,"alias"); 
  couple * c = malloc(sizeof(couple));
  char * txt   ;
  char * alias ;
  if (ou != NULL){
    line = jump_space(line);
    txt = save(line);
    ou += 5;// a.l.i.a.s
    ou = jump_space(ou);
    alias = save(ou);
  } else return NULL;
  c->txt = txt;
  c->alias = alias;
  return c;
}


void mk_out(char * out, char * in){
  int l = strlen(in);
  int i;
  char trts[5] = "strt.";
  char ttl[4] = "ttl";
  for (i = l-1; i > l-6 && trts[l-i-1] == in[i] ; i--);
  if (i == l - 6){//il y a le .ttl
    for (i = 0 ; i < l-4 ; i++)
      out[i] = in[i];
    for (i = l-4 ; i < l; i++)
      out[i] = ttl[i-l+4];
  } else {
    for (i = 0 ; i < l ; i++)
      out[i] = in[i];
    out[l] = '.';
    for (i = l+1 ; i < l+4 ; i++)
      out[i] = ttl[i-l-1];
  }
}


int main (int argc, char * argv[]){
  char cmd[200];
  char out[200];
  if ( argc < 2 ) {
    errno = EINVAL;
    perror("command is \"unturtoise [-i] file\"");
    return 0;
  }
  if( access( argv[1], F_OK ) != -1 ) {
    if (argc == 3 && strstr(argv[2],"-i")){
      printf("in place\n");
      translate(argv[1]);
    } else {
      mk_out(out,argv[1]);
      sprintf(cmd,"cp %s %s",argv[1],out);
      system(cmd);
      translate(out);
    }
  } else {
    perror("Input error: file does not exist\n");
    return 0;
  }

  /*
  couple * c = is_alias("bonjour alias salut");
  if (c != NULL)  printf("txt: %s \nalias: %s \n",c->txt, c->alias);
  else printf("NULL\n");
  */
  
  return 0; 
}
