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

class Teacher: public Person{
    public:
        void setTitle(std::string tt){ title = tt;}
        std::string getTitle(){return title;}

    private:
        std::string title;
};

class Student: public Person{
    public:
        void setNoteDate(int day, int month, int year) {noteDate.day = day;noteDate.month = month;noteDate.year = year;};
        std::string getNoteDate() {
            return std::to_string(noteDate.day) + "/" + std::to_string(noteDate.month) + "/" + std::to_string(noteDate.year);
        };

        void setContent(std::string ct) {content = ct;};
        std::string getContent() {
            return content;
        };

    private:
        std::string content;
        struct datee noteDate;
};

void teacherTable(Teacher tr){
    std::cout << "\n--- TEACHER --- " << std::endl;
    std::cout << tr.getTitle() << " " << tr.getFirstName() << " " << tr.getLastName() << std::endl;
    std::cout << "Birth - " << tr.getBirthDate() << "\n"<< std::endl;
}

int main() {
    Teacher t1;
    t1.setTitle("Mgr.");
    t1.setFirstName("Filip");
    t1.setLastName("Grznar");
    t1.setBirthDate(2,4,1986);
    teacherTable(t1);

    Student st1;
    st1.setFirstName("Varlos");
    st1.setLastName("Kremrola");
    st1.setBirthDate(1,1,2001);
    st1.setNoteDate(10,10,2010);
    st1.setContent("Podle doktorů se bohužel potvrdilo to, v co jsem tajně doufal, že se nepotvrdí. Urval jsem sakumprásk všechno, co šlo. Zranění je tak rozsáhlé, že všechno najednou operovat nešlo, je tam hodně práce a čeká mě série operací,");
    std::cout << st1.getFirstName() << " " << st1.getLastName() << " - " << st1.getBirthDate() << "\n-Last Note-\n" << st1.getContent() << "\nDate-" << st1.getNoteDate() << "\n" << std::endl;

    std::string teacherTitle,teacherFirstName,teacherLastName;
    int teacherBDay,teacherBMonth,teacherBYear;

    Teacher t2;
    std::cout << "Create your own teacher.\nTitle:" << std::endl;
    std::cin >> teacherTitle;
    std::cout << "Fist name:" << std::endl;
    std::cin >> teacherFirstName;
    std::cout << "Last name:" << std::endl;
    std::cin >> teacherLastName;
    std::cout << "Day of his/her birth:" << std::endl;
    std::cin >> teacherBDay;
    std::cout << "Month of his/her birth:" << std::endl;
    std::cin >> teacherBMonth;
    std::cout << "Year of his/her birth:" << std::endl;
    std::cin >> teacherBYear;
    t2.setTitle(teacherTitle);
    t2.setFirstName(teacherFirstName);
    t2.setLastName(teacherLastName);
    t2.setBirthDate(teacherBDay,teacherBMonth,teacherBYear);
    teacherTable(t2);
    return 0;
} 
