#include <iostream>
#include <string>
#include <ctime>
//using namespace std;

int main() {
    int aa = 5;
    int noAge = 10;
    float ab = 5.99;
    double ac = 9.98;
    
    std::string ad = "Zlín";
    char ae = 'a';
    bool af = true;

    #define minAge 18
    const std::string minHeight = "150cm";

    int hAge;
    hAge = 99;

    std::cout << hAge+aa << std::endl; // int+int
    std::cout << ab+aa << std::endl; // float+int
    std::cout << ac+ab << std::endl; // double+float
    std::cout << minHeight+ad << std::endl; // string + string
    std::cout << minHeight+ae << std::endl; // string + char

    std::cout << "\nHow old are you ?" << std::endl;
    std::cin >> hAge;

    if(hAge>=18){
        std::cout << "You, can go inside.";
    }else if(std::to_string(hAge).length()>=3){
        std::cout << "Wow you are over a 100 years old";
    }else{
        std::cout << "How did you get here?";
    }

    int rate;
    std::cout << "\nRate your mood from 1 to 5." << std::endl;
    std::cin >> rate;
    switch(rate){
        case 1:
            std::cout << "What happened?" << std::endl;
            break;
        case 2:
            std::cout << "Not bad" << std::endl;
            break;
        case 3:
            std::cout << "Good" << std::endl;
            break;        
        case 4:
            std::cout << "Super" << std::endl;
            break;        
        case 5:
            std::cout << "Very nice" << std::endl;
            break;        
        default:
            std::cout << "This option does not exist." << std::endl;
            break;
    }
    
    std::string mmAge = (noAge < 18) ? "Set it up to 18." : "OK";
    std::cout << mmAge << "\n" << std::endl;

    std::string quakeC[] = {"Bitterman", "Ranger", "Shub-Niggurath", "Xaero"};
    for (std::string x : quakeC)
        std::cout << x << std::endl;
        
    std::cout << std::endl;

    for (int i = 0; i<sizeof(quakeC)/sizeof(quakeC[0]); i++){
        std::cout << quakeC[i] << std::endl;
    }

    time_t ltime;
 
    std::cout << time(&ltime) << std::endl;
    int even = 0;
    int twoPlus = 0;
    long cas = time(&ltime)+2;

    while(time(&ltime)%2==0){
        even++;
    }

    do {
        twoPlus++;
    } 
    while(time(&ltime)<cas);

    std::cout << even <<std::endl;
    std::cout << twoPlus << std::endl;


    int tdArray[2][5] = {{5, 7, 8, 10, 20}, {1, 3, 6, 17, 19}};
    std::cout << tdArray[1][2] << "\t" << tdArray[2][4]+tdArray[1][1] << std::endl;

    for(int fr = 0; fr <= 1; fr++){
        for(int rr = 0; rr<5; rr++){
            std::cout << tdArray[fr][rr] << " | ";
        }
        std::cout << std::endl;
    }
    
    std::cout << "\n" << std::endl;
    
    int fdArray[2][3][3][2][5] = {
            {
            {{{1, 9, 10, 17, 18}, {2, 4, 10, 12, 13}},
            {{2, 5, 10, 17, 19}, {3, 7, 12, 17, 20}},
            {{10, 13, 14, 17, 18}, {2, 6, 12, 15, 16}}},

            {{{6, 7, 9, 13, 19}, {4, 9, 13, 19, 20}},
            {{1, 7, 9, 13, 19}, {1, 6, 13, 14, 18}},
            {{2, 5, 12, 15, 19}, {8, 10, 11, 13, 16}}},

            {{{1, 4, 6, 14, 20}, {5, 7, 11, 13, 20}},
            {{7, 13, 16, 17, 18}, {1, 10, 12, 13, 19}},
            {{5, 7, 8, 10, 20}, {1, 3, 4, 7, 18}}}
            },
                        
            {
            {{{1, 2, 7, 8, 18}, {2, 8, 11, 17, 20}},
            {{1, 5, 9, 13, 16}, {4, 5, 16, 17, 19}},
            {{8, 9, 15, 16, 19}, {1, 4, 7, 13, 17}}},

            {{{3, 6, 9, 11, 17}, {1, 8, 10, 12, 20}},
            {{8, 9, 10, 12, 18}, {12, 13, 14, 15, 18}},
            {{1, 2, 6, 7, 17}, {4, 6, 11, 12, 16}}},

            {{{6, 11, 14, 15, 19}, {3, 4, 5, 7, 9}},
            {{5, 7, 12, 19, 20}, {3, 4, 6, 17, 19}},
            {{4, 5, 12, 15, 18}, {1, 3, 6, 17, 19}}}
            }
        };

    int vel = sizeof(fdArray)/sizeof(fdArray[0][0][0][0][0]);
    for(int aa = 0; aa<=1; aa++){
        for(int ab = 0; ab<=2; ab++){
            for(int ac = 0; ac<=2; ac++){
                for(int ad = 0; ad<=1; ad++){
                    for(int af = 0; af<=4; af++){
                        std::cout << fdArray[aa][ab][ac][ad][af] << " | ";
                    }
                std::cout << std::endl;
                }
            std::cout << std::endl;
            }
        std::cout << std::endl;
        }
    std::cout << std::endl;
    }    

return 0;
} 