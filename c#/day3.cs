using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;

namespace day3
{
    internal class Program
    {
        public static int MaxB(string s)
        {
            int maxRight = -1;
            int best = -1;
            for(int i = s.Length -1; i >= 0; i--)
            {
                int d = Int32.Parse(s.Substring(i,1));
                if(maxRight != -1)
                {
                    int candidate = 10 * d + maxRight;
                    if(candidate > best)
                    {
                        best = candidate;
                    }
                }
                if(d > maxRight)
                {
                    maxRight = d;
                }
            }
            if(best != -1 )
            {
                return best;
            }
            return 0;
        }
        static void Main(string[] args)
        {
            string input = @"day3.txt";
            if (File.Exists(input))
            {
                string readInput = File.ReadAllText(input);
                string[] vrstica = Regex.Split(readInput, "\n");
                List<int> numbers = new List<int>();
                foreach(var v in vrstica)
                {
                    numbers.Add(MaxB(v.Trim()));
                    
                }
                Console.WriteLine($"Part 1: {numbers.Sum()}");
                Console.ReadLine();
            }else
            {
                Console.WriteLine("File not found");
            }
        }
    }
}
