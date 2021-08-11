#include <iostream>
#include <string>
#include <cstring>
#include <algorithm>
#include <unistd.h>
//using namespace std;

//Student - křestní jméno, příjmení, datum narození, datum zápisu - done
//Učitel - titul, křestní jméno, příjmení, datum narození
struct datee{
    int day;
    int month;
    int year;
};

class Teacher{
    public:
        void setBirthDate(int day, int month, int year) {birthDate.day = day;birthDate.month = month;birthDate.year = year;};
        std::string getBirthDate() {
            return std::to_string(birthDate.day) + "/" + std::to_string(birthDate.month) + "/" + std::to_string(birthDate.year);
        };

        void setTitle(std::string tt){ title = tt;}
        std::string getTitle(){return title;}

    private:
        std::string title;
        std::string firstName;
        std::string secondName;
        struct datee birthDate;
};

class Student{
    public:
        void setBirthDate(int day, int month, int year) {birthDate.day = day;birthDate.month = month;birthDate.year = year;};
        std::string getBirthDate() {
            return std::to_string(birthDate.day) + "/" + std::to_string(birthDate.month) + "/" + std::to_string(birthDate.year);
        };

        void setNoteDate(int day, int month, int year) {noteDate.day = day;noteDate.month = month;noteDate.year = year;};
        std::string getNoteDate() {
            return std::to_string(noteDate.day) + "/" + std::to_string(noteDate.month) + "/" + std::to_string(noteDate.year);
        };

        void setFirstName(std::string fName){ firstName = fName;}
        std::string getFirstName(){return firstName;}

        // atd.....

    private:
        std::string firstName;
        std::string secondName;
        struct datee birthDate;
        struct datee noteDate;
};

int main() {
    Teacher t1;
    t1.setTitle("Zgarb");
    std::cout << " - " <<  t1.getTitle() << " - " << std::endl;

    Student st1;
    st1.setFirstName("Nikdo");
    st1.setBirthDate(1,1,2001);
    st1.setNoteDate(10,10,2010);
    std::cout << st1.getFirstName() << " - " << st1.getBirthDate() << " - " << st1.getNoteDate() << std::endl;

    return 0;
} 
