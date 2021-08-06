#include <iostream>
#include <string>
#include <cstring>
#include <algorithm>
//using namespace std;

void intByReference(int &i)
{
    i++;
    std::cout << i << std::endl;
} 

std::string stringByValue(std::string a){
    a.erase(std::remove_if(a.begin(), a.end(), ::isspace), a.end());
    a.erase(std::remove(a.begin(), a.end(), '.'), a.end());
    for (int i = 0; i<a.length(); i++){
        for(int l = a.length(); l>i ; l--){
            std::cout << "." ;
        }
        std::cout << a[i] << std::endl;
    }
    return a;
} 

float floatByReference(float &h, float &w){
    return w/(h/100*2);
}

float pointerWinRatio(int *w, int *l){
    *w  = 50;
    return (*w/(*l));
};

template <size_t N>
void arrayByPointer(std::string (&a)[N], int b[]){ 
    for (int i = 0; i<sizeof(a)/sizeof(a[0]); i++){
        std::cout << i+1 << ". " << a[i] << " " << b[i*2] << "-" << b[i*2+1]<<std::endl;
    }
};  

int triangleC(int a = 2, int b = 2, int c = 3){
    return a+b+c;
}

int main() {
    int y = 10;
    int team;
    intByReference(y);
    std::cout << y << std::endl;

    std::string lckTeams[] = {"Nongshim RedForce","Gen.G","Liiv SANDBOX","DWG KIA","T1","Afreeca Freecs","Hanwha Life Esports","KT Rolster","Fredit BRION", "DRX"};
    int result[] = {11,4,10,4,10,5,10,6,9,6,8,7,6,10,5,10,5,11,2,13};
    std::cout << "Enter position of the team(1-10)." << std::endl;
    std::cin >> team;
    while(!(team > 0 && team<=10)){
        std::cin >> team;
    }
    stringByValue(lckTeams[team-1]);            
    arrayByPointer(lckTeams,result);

    //BMI
    bool isOk;
    std::string fk;
    std::cout << "Are you 18-65 years old?" << std::endl;
    std::cin >> isOk;
    if(isOk == true){
        float height;
        std::cout << "Please enter your height.(CM)" << std::endl;
        std::cin >> height;

        float weight;
        std::cout << "Please enter your weight.(KG)" << std::endl;
        std::cin >> weight;
        
        std::cout << "Your BMI:" << floatByReference(height,weight) << std::endl;

        if(floatByReference(height,weight)>24.9){
            std::cout << "According to BMI you have overweight." << std::endl;
        }else if(floatByReference(height,weight)<18.5){
            std::cout << "According to BMI you have underweight." << std::endl;
        }
        else{
            std::cout << "Your BMI is normal." << std::endl;   
        }
    }

    std::cout << "\n" << "3parametry - " << triangleC(2,4,2) << std::endl;
    std::cout << "2parametry - " << triangleC(1,4) << std::endl;
    std::cout << "1parametr - " << triangleC(8) << std::endl;
    std::cout << "Default - " << triangleC() << std::endl;

    int w = 3;
    int l = 2;
    
    std::cout << "\nBefore: "<< w << std::endl;
    std::cout << pointerWinRatio(&w,&l) << "%" << std::endl;
    std::cout << "After: "<< w << std::endl;

    return 0;
} 