#include <iostream>
#include <string>
#include <cstring>
#include <algorithm>
#include <unistd.h>
//using namespace std;

struct datee{
    int day;
    int month;
    int year;
};

class Person{
    public:
        void setFirstName(std::string fName){ firstName = fName;}
        std::string getFirstName(){return firstName;}

        void setLastName(std::string lName){ lastName = lName;}
        std::string getLastName(){return lastName;}

        void setBirthDate(int day, int month, int year) {birthDate.day = day;birthDate.month = month;birthDate.year = year;};
        std::string getBirthDate() {
            return std::to_string(birthDate.day) + "/" + std::to_string(birthDate.month) + "/" + std::to_string(birthDate.year);
        };

    private:
        std::string firstName;
        std::string lastName;
        struct datee birthDate;
};

class Note{
    public:
        std::string content;
        void setNoteDate(int day, int month, int year) {noteDate.day = day;noteDate.month = month;noteDate.year = year;};
        std::string getNoteDate() {
            return std::to_string(noteDate.day) + "/" + std::to_string(noteDate.month) + "/" + std::to_string(noteDate.year);
        };

    private:
        struct datee noteDate;
};

class Teacher: public Person{
    public:
        void setTitle(std::string tt){ title = tt;}
        std::string getTitle(){return title;}

    private:
        std::string title;
};

class Student: public Person, public Note{
    public:
        void learning(){
            std::cout << "I'm learning." << std::endl;
            sleep(5);
            std::cout << "I stopped learning." << std::endl;
        }
};

void teacherTable(std::string t, std::string f, std::string l, std::string b){
    std::cout << "\n--- TEACHER --- " << std::endl;
    std::cout << t << " " << f << " " << l << std::endl;
    std::cout << "Birth - " << b << "\n"<< std::endl;
}

int main() {
    Teacher t1;
    t1.setTitle("Mgr.");
    t1.setFirstName("Filip");
    t1.setLastName("Grznar");
    t1.setBirthDate(2,4,1986);
    teacherTable(t1.getTitle(),t1.getFirstName(),t1.getLastName(),t1.getBirthDate());

    Student st1;
    st1.setFirstName("Varlos");
    st1.setLastName("Kremrola");
    st1.setBirthDate(1,1,2001);
    st1.setNoteDate(10,10,2010);
    st1.content = "Podle doktorů se bohužel potvrdilo to, v co jsem tajně doufal, že se nepotvrdí. Urval jsem sakumprásk všechno, co šlo. Zranění je tak rozsáhlé, že všechno najednou operovat nešlo, je tam hodně práce a čeká mě série operací,";
    std::cout << st1.getFirstName() << " " << st1.getLastName() << " - " << st1.getBirthDate() << "\n-Last Note-\n" << st1.content << "\nDate-" << st1.getNoteDate() << "\n" << std::endl;

    std::string t2T,t2F,t2L;
    int t2D,t2M,t2Y;

    Teacher t2;
    std::cout << "Create your own teacher.\nTitle:" << std::endl;
    std::cin >> t2T;
    std::cout << "Fist name:" << std::endl;
    std::cin >> t2F;
    std::cout << "Last name:" << std::endl;
    std::cin >> t2L;
    std::cout << "Day of his/her birth:" << std::endl;
    std::cin >> t2D;
    std::cout << "Month of his/her birth:" << std::endl;
    std::cin >> t2M;
    std::cout << "Year of his/her birth:" << std::endl;
    std::cin >> t2Y;
    t2.setTitle(t2T);
    t2.setFirstName(t2F);
    t2.setLastName(t2L);
    t2.setBirthDate(t2D,t2M,t2Y);
    teacherTable(t2.getTitle(),t2.getFirstName(),t2.getLastName(),t2.getBirthDate());
    return 0;
} 
