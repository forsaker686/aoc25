using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;

namespace day1
{
    internal class Program
    {
        static void Main(string[] args)
        {
            string input = @"day1.txt";
            if (File.Exists(input)) {
                string readInput = File.ReadAllText(input);
                string[] vrstica = Regex.Split(readInput, "\n");
                int zacetna = 50;
                int stevec = 0;
                int stevec2 = 0;
                foreach(string n in vrstica)
                {
                    string smer = n.Substring(0, 1);
                    string vrednost = n.Substring(1);
                    for(int i=0; i < Int32.Parse(vrednost); i++)
                    {
                        if(smer == "L")
                        {
                            zacetna--;
                            if (zacetna < 0) zacetna = 99;
                        }else
                        {
                            zacetna++;
                            if (zacetna > 99) zacetna = 0;
                        }
                        if(zacetna == 0)
                        {
                            stevec2++;
                        }
                    }
                    if(zacetna == 0)
                    {
                        stevec++;
                    }
                }
                Console.WriteLine($"part 1: {stevec}");
                Console.WriteLine($"part 2: {stevec2}");
                Console.ReadLine();
            }else
            {
                Console.WriteLine("no input file found");
            }
        }
    }
}
