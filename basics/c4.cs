using System;
#pragma warning disable


//Factory method
class Hero{
  public Hero(string name, int baseHealth, int baseArmour, string activeAbility, int cooldown, string passiveAbility, int speed)
        {
            this.name=name;
            this.baseHealth=baseHealth;
            this.baseArmour=baseArmour;
            this.activeAbility=activeAbility;
            this.cooldown=cooldown;
            this.passiveAbility=passiveAbility;
            this.speed=speed;
        }

  // public void Ttest(){
  //     Console.WriteLine(name);
  // }

      string name;
      int baseHealth;
      int baseArmour;
      string activeAbility;
      int cooldown;
      string passiveAbility;
      int speed;
};

class HeroFactory{
      public Hero generateRanger(){
        return new Hero("Ranger – Slipgate Marine", 100, 25, "Dire Orb", 20, "Son of a Gun", 320);
      }
};
//

//Factory 
class Pistol{
      public Pistol(string type, int rpm, int muzzleVelocity){
          this.type=type;
          this.rpm=rpm;
          this.muzzleVelocity=muzzleVelocity;
      }

      public static Pistol glock(){
          return new Pistol("semi-automatic",1200,375);
      }

      public void Ttest(){
           Console.WriteLine(type);
      }

      string type;
      int rpm;
      int muzzleVelocity;
};
//

//Singleton
class Confusion{
  public static Confusion get(){
      if(instance == null)
        instance = new Confusion();
      return instance;
  }
  public static string Nervy(){return get().INervy();}

  private Confusion(){ }
  private static Confusion instance = null;

  string INervy(){ return m_VKyblu;}
  string m_VKyblu = "Nervz";
}
class c4
{
  static void Main(string[] args)
  {
    HeroFactory factory = new HeroFactory();
    Hero Ranger = factory.generateRanger();
    //Ranger.Ttest();

    Pistol glock = Pistol.glock();
    //glock.Ttest();
        
    Console.WriteLine(Confusion.Nervy());

  }
}
