package es.garchypielago.dwes;
import net.datafaker.Faker;
//TIP To <b>Run</b> code, press <shortcut actionId="Run"/> or
// click the <icon src="AllIcons.Actions.Execute"/> icon in the gutter.
public class Main {
    public static void main(String[] args) {

        Faker faker = new Faker();

        String name = faker.name().fullName(); // Miss Samanta Schmidt
        String firstName = faker.name().firstName(); // Emory
        String lastName = faker.name().lastName(); // Barton

        String streetAddress = faker.address().streetAddress(); // 60018 Sawayn Brooks Suite 449
        //TIP Press <shortcut actionId="ShowIntentionActions"/> with your caret at the highlighted text
        // to see how IntelliJ IDEA suggests fixing it.
        System.out.printf(streetAddress);
    }
}