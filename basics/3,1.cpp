#include <iostream>
#include <string>
#include <cstring>
#include <algorithm>
#include <unistd.h>
//using namespace std;

class heroSkeleton{
    public:
        void setTitle(std::string tt) {title = tt;};
        std::string getTitle() {return title;};

        void setDesc(std::string ds) {desc = ds;};
        std::string getDesc() {return desc;};

        void setHp(int h) {hp = h;};
        int getHp() {return hp;};

        void setAr(int ar) {armor = ar;};
        int getAr() {return armor;};

        void setSp(int sp) {speed = sp;};
        int getSp() {return speed;};

        void getInfo(){
            std::cout << "TITLE->" << title << std::endl;
            std::cout << "DESC->" << desc << std::endl;
            std::cout << "//\\//\\//\\//\\//\\//\\" << std::endl;
            std::cout << "HP->" << hp << std::endl;
            std::cout << "ARMOR->" << armor << std::endl;
            std::cout << "SPEED->" << speed << std::endl;
        }

    private:
        std::string title;
        std::string desc; 
        int hp;
        int armor;
        int speed;
};

class mage: private heroSkeleton{
    public:
        

    private:
        int haste;
        int versatility;
        int mastery;
        int criticalStrike;
};

class fight{
    public:
        std::string fighter1;
        std::string fighter2;
        float timer;
        void startFight(){
            int hp1 = 10;
            int hp2 = 10;
            int roundNumber = 1;
            int att;
            int who;

            srand (time(NULL));
            std::cout << "-- THE FIGHT BEGINS --" << std::endl;
            while((hp1 > 0)&&(hp2 > 0)){
                std::cout << "-- " << roundNumber << ". ";
                who = rand() % 10 + 1;
                att = rand() % 5 + 1;
                if(who>5){
                    std::cout << fighter2 << " attacks for " << att << "hp." << std::endl;
                    hp1 -= att;
                }else{
                    std::cout << fighter1 << " attacks for " << att << "hp." << std::endl;
                    hp2 -= att;
                }
                sleep(timer);
                roundNumber++;
            }
            
            std::cout << "--------" << std::endl;

            if(hp1 > 0){
                std::cout << fighter1 << " won in round number " << roundNumber  << ". with " << hp1 << "hp left, congratulation." << std::endl;
            }else{
                std::cout << fighter2 << " won in round number " << roundNumber  << ". with " << hp2 << "hp left, congratulation." << std::endl;
            }
        };

    fight(std::string f1 = "fighter1", std::string f2 = "fighter2", float t = 1.0f){
        fighter1 = f1;
        fighter2 = f2;
        if(t != 0){
            timer = t;
        }
    }
};

int main() {
    std::string p1;
    std::string p2;
    float tt;

    std::cout << "Player 1 name:" << std::endl;
    std::cin >> p1;
    std::cout << "Player 2 name:" << std::endl;
    std::cin >> p2;
    std::cout << "Time between rounds(in seconds):" << std::endl;
    std::cin >> tt;
    fight n(p1,p2,tt);
    n.startFight();

    return 0;
} 
