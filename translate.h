
#define BUF_SIZE 4096
#define TXT_SIZE 1024

struct couple {
  char * txt;
  char * alias;
};
typedef struct couple couple;


char * get_line(FILE * f, char * buf);
void translate(char * pn);
char * jump_space(char * s);
char * save (char * s);
couple * is_alias(char * line);
void rm_return(char * s);
