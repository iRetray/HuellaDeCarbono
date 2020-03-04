#include <iostream>
using namespace std;

string abecedario[27] = {"A","B","C","D","E","F","G","H","I","J","K","L","M","N","Ñ","O","P","Q","R","S","T","U","V","W","X","Y","Z"};

string valorDeCesar(char letra){
  string letraString(1, letra);
  if(letraString==" "){
    return " ";
  }
  for(int i=0;i<27;i++){
    string letraString(1, letra);
    if(letraString==abecedario[i]){
      return abecedario[i+3];
    }
  }
  return " ";
}

int main() {
  cout<<"Codificacion Cesar"<<endl;
  string palabra;
  cout<<"Escribe la palabra"<<endl;
  cin>>palabra;
  string codificacion[palabra.length()];
  string abecedario[27] = {"A","B","C","D","E","F","G","H","I","J","K","L","M","N","Ñ","O","P","Q","R","S","T","U","V","W","X","Y","Z"};
  for(int i=0;i<palabra.length()+1;i++){
    codificacion[i] = valorDeCesar(palabra[i]);
    cout<<"Letra: "<<palabra[i]<<" es igual a "<<codificacion[i]<<endl;
  }
  return 0;
}