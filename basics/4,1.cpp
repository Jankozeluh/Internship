#include <iostream>
#include <string>
#include <cstring>
#include <algorithm>
#include <unistd.h>
//using namespace std;


//Factory Method
class Hero{
    public:
        Hero(std::string name, int baseHealth, int baseArmour, std::string activeAbility, int cooldown, std::string passiveAbility, int speed)
        {
            this->name=name;
            this->baseHealth=baseHealth;
            this->baseArmour=baseArmour;
            this->activeAbility=activeAbility;
            this->cooldown=cooldown;
            this->passiveAbility=passiveAbility;
            this->speed=speed;
        }

    private:
        std::string name;
        int baseHealth;
        int baseArmour;
        std::string activeAbility;
        int cooldown;
        std::string passiveAbility;
        int speed;
};

class HeroFactory{
    public:
        Hero* generateRanger(){
            return new Hero("Ranger – Slipgate Marine", 100, 25, "Dire Orb", 20, "Son of a Gun", 320);
        }
};
//

//Factory
class Pistol{
    public:
        Pistol(std::string type, int rpm, int muzzleVelocity){
            this->type=type;
            this->rpm=rpm;
            this->muzzleVelocity=muzzleVelocity;
        }

        static Pistol* glock(){
            return new Pistol("semi-automatic",1200,375);
        }

    private:
        std::string type;
        int rpm;
        int muzzleVelocity;
};
//

//Singleton
class Confusion{
    public:
        Confusion(const Confusion&) = delete; // zabraňuje předání instance hodnotou

        static Confusion& Get(){
            static Confusion instance;
            return instance;
        }
        static std::string Nervy(){return Get().INervy();};
    private:
        std::string INervy(){ return m_VKyblu;};
        Confusion(){}
        std::string m_VKyblu = "Nervz";
};
//

int main() {
    HeroFactory* factory = new HeroFactory();
    Hero* Ranger = factory->generateRanger();

    Pistol::glock();

    std::cout << Confusion::Nervy() << std::endl;

    return 0;
} 

//https://stackoverflow.com/questions/1008019/c-singleton-design-pattern <- tu to je rozepsané, jsem z toho kontrolování proměnné v C++ dost zmatený
